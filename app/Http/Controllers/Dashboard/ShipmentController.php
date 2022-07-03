<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Province;
use App\Traits\GeneralTrait;
use App\Traits\ShipmentTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Shipment;

//use Validator;
use App\Models\Weight;
use App\Models\WeightCompany;
use App\Models\ShippingAreaPrice;
use App\Models\CompanyShippingAreaPrice;
use App\Models\AdditionalService;
use App\Models\RepresentativeAccountDetail;

class ShipmentController extends Controller
{
    use GeneralTrait;
    use ShipmentTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_representative($id)
    {

        $RepresentativeAccountDetail = RepresentativeAccountDetail::where([
            ['representative_account_id', "!=", NULL],
            ['representative_id', $id],
            ['admin_id',$this->idAdmin()]
        ])->get()->pluck('shipment_id')->toArray();

        $shipment = Shipment::with('area', 'client', 'representative', 'serviceType', 'shipmentstatu', 'additionalservice', 'store', 'user')
            ->where([['representative_id', $id],['admin_id',$this->idAdmin()]])->whereNotIn('id', $RepresentativeAccountDetail)->get();


        return $this->returnData('shipment', $shipment, 'successfully');


//        return $this->returnData('shipment', $shipment, 'successfully');

    }

    public function index(Request $request)
    {
        foreach ($request->all() as $key => $value)
            $request->merge([$key => $value == "'undefined'" || $value == "'null'" || $value == "null" || $value == "undefined" ? null : $value]);
//        return $request;

        $data = [];



        $shipment = Shipment::with('area', 'client', 'representative', 'serviceType', 'shipmentstatu', 'additionalservice', 'store', 'user')
            ->where(function ($q) use ($request) {
                $q->when($request->date, function ($q) {
                    $q->whereDate('created_at', now()->format('Y-m-d'));
                });
            })->where(function ($q)  {
                $q->where('admin_id',$this->idAdmin());
            })
            ->where(function ($q) use ($request) {
                $q->when($request->start_date && $request->end_date, function ($q) use ($request) {
                    $q->whereDate('created_at', ">=", $request->start_date)
                        ->whereDate('created_at', "<=", $request->end_date);

                });
            })->where(function ($q) use ($request) {
                $q->when($request->shipment_status_id, function ($q) use ($request) {
                    $q->where('shipment_status_id', $request->shipment_status_id);
                });
            })->where(function ($q) use ($request) {
                $q->when($request->representative_id, function ($q) use ($request) {
                    $q->where('representative_id', $request->representative_id);
                });
            })
            ->where(function ($q) use ($request) {
                $q->when($request->search, function ($q) use ($request) {
                    $q
                        ->whereHas('user', function ($q) use ($request) {
                            $q->whereHas('company', function ($q) use ($request) {
                                $q->where('name', 'like', '%' . $request->search . "%");
                            });
                        })
                        ->orWhereHas('client', function ($q) use ($request) {
                            $q->where('name', 'like', '%' . $request->search . "%")
                                ->orWhere('phone', 'like', '%' . $request->search . "%");
                        })
                        ->orWhereHas('area', function ($q) use ($request) {
                            $q->where('name', 'like', '%' . $request->search . "%");
                        })
                        ->orWhereHas('shipmentstatu', function ($q) use ($request) {
                            $q->where('name', 'like', '%' . $request->search . "%");
                        })
                        ->orWhereHas('serviceType', function ($q) use ($request) {
                            $q->where('type', 'like', '%' . $request->search . "%");
                        })->orWhere('name_shipment', 'like', '%' . $request->search . "%");
                });

            })
            ->latest()->paginate(20);
        $count_shipment = Shipment::where('admin_id',$this->idAdmin())->count();
        $total_cod = Shipment::where('admin_id',$this->idAdmin())->get()->sum('total_shipment');

        $data['shipment'] = $shipment;
        $data['count_shipment'] = $count_shipment;
        $data['total_cod'] = $total_cod;


        return $this->returnData('data', $data, 'successfully');

    }



    public function shipment_area($id)
    {
        $provinces = Province::where('admin_id',$this->idAdmin())->get();
        $data = [];
        $data_area = [];
        foreach ($provinces as $index => $province) {
            $length = 0;
            foreach ($province->areas as $area) {

                if (count($area->shipping_area_price) > 0) {

                    unset($area['shipping_area_price']);

                    $data_area[$length] = $area;

                    $length += 1;
                }

            }
            unset($province['areas']);
            $data[$index] = $province;
            $data[$index]['areas'] = $data_area;
        }

        return $this->returnData('province', $data, 'successfully');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            //      =================validate on Table  Models User and Client

            foreach ($request->all() as $key => $value)
                $request->merge([$key => $value == "undefined" || $value == "null" ? null : $value]);

            $validation = Validator::make($request->all(), [

                'name' => 'required|string',
                'address' => 'required|string',
                'phone' => 'required|min:11|unique:clients',
                'name_shipment' => 'required|string',
                'description' => 'nullable|string',
                'customer_code' => 'nullable|integer',
                'product_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'order_number' => 'nullable|integer',
                'count' => 'nullable|integer',
                'delivery_date' => 'nullable|date',
                'weight' => 'nullable|integer',
                'size' => 'nullable|string',
                'notes' => 'nullable|string',
                'area_id' => 'required|exists:areas,id',
                'service_type_id' => 'required|exists:service_types,id',
                'sender_id' => 'required|exists:users,id',
                'store_id' => 'nullable|exists:stores,id',
                'shipment_status_id' => 'nullable|exists:shipment_status,id',
                'representative_id' => 'nullable|exists:representatives,id',
                'additional_service_id' => 'nullable|exists:additional_services,id',
                'reason_id' => 'nullable|exists:reasons,id',
            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }
//            return $request;

            //      =================upload  photo  App\Models\Client

            if ($request->hasFile('photo')) {
                $file = $request->photo;
                $new_file = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/client', $new_file);
            } else {
                $new_file = null;
            }
            //      =================App\Models\Client

            $client = Client::where('admin_id',$this->idAdmin())->create([

                'name' => $request->name,
                'email_2' => $request->email_2,
                'address' => $request->address,
                'google_location' => $request->google_location,
                'phone' => $request->phone,
                'phone_2' => $request->phone_2,
                'photo' => $new_file,

            ]);
            //      ================= calculator  AdditionalService
            $additional_service = AdditionalService::where([['id', $request->additional_service_id],['admin_id',$this->idAdmin()]])->first();

            $price_additional_service = 0;
            if ($additional_service) {
                $price_additional_service = $additional_service->price;
            }


            //      ================= calculator  weight

            $weight = Weight::where('admin_id',$this->idAdmin())->first();

            $weight_company = WeightCompany::where([['company_id', $request->sender_id],['admin_id',$this->idAdmin()]])->first();
            $weight_price = 0;

            if ($weight_company) {
                if ($request->weight > $weight_company->limit) {
                    $weight_price = ($request->weight - $weight_company->limit) * $weight_company->price;
                }
            } else {
                if ($request->weight > $weight->limit) {
                    $weight_price = ($request->weight - $weight->limit) * $weight->price;
                }
            }

            //      ================= calculator  shipping price

            $shipping_area_price = ShippingAreaPrice::where([['area_id', $request->area_id],['admin_id',$this->idAdmin()]])->first();
            $company_shipping_area_price = CompanyShippingAreaPrice::where([['company_id', $request->sender_id], ['area_id', $request->area_id],['admin_id',$this->idAdmin()]])->first();
            $transportation_price_shipping = 0;

            if ($company_shipping_area_price) {

                $transportation_price_shipping = $company_shipping_area_price->transportation_price;
            } elseif (!$company_shipping_area_price) {

                $transportation_price_shipping = $shipping_area_price->transportation_price;
            }

            $shipping_price = $transportation_price_shipping + $weight_price + $price_additional_service;

            //      =================App\Models\Shipment

            $shipment = Shipment::create([
                'client_id' => $client->id,
                'name_shipment' => $request->name_shipment,
                'description' => $request->description,
                'customer_code' => $request->customer_code,
                'product_price' => $request->product_price,
                'order_number' => $request->order_number,
                'shipping_price' => $shipping_price,
                'weight' => $request->weight,
                'size' => $request->size,
                'count' => $request->count,
                'delivery_date' => $request->delivery_date,
                'notes' => $request->notes,
                'area_id' => $request->area_id,
                'service_type_id' => $request->service_type_id,
                'representative_id' => $request->representative_id,
                'shipment_status_id' => $request->shipment_status_id,
                'sender_id' => $request->sender_id,
                'store_id' => $request->store_id,
                'additional_service_id' => $request->additional_service_id,
                'reason_id' => $request->reason_id,
                'admin_id' => $this->idAdmin(),


            ]);
            $shipment->area;
            $shipment->client;
            $shipment->representative;
            $shipment->serviceType;
            $shipment->user;
            $shipment->store;

            DB::commit();

//            return response()->json($client);

            return $this->returnData('shipment', $shipment, 'successfully');

            // all good
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shipment = Shipment::where('admin_id',$this->idAdmin())->with('area', 'client', 'representative', 'serviceType', 'shipmentstatu', 'additionalservice', 'store', 'user','admin')->findOrFail($id);

        return $this->returnData('shipment', $shipment, 'successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            foreach ($request->all() as $key => $value)
                $request->merge([$key => $value == "undefined" ? null : $value]);

//            $data = collect($request->all())->filter()->toArray();
//            return $data;
//            foreach ($request->all() as $key => $value)
//                $request->merge([$key => $value =="undefined" ? null : $value]);

            //      =================update validate on Table  Models User and Client
            $shipment = Shipment::where('admin_id',$this->idAdmin())->findOrFail($id);
            $client = Client::where('admin_id',$this->idAdmin())->find($shipment->client_id);
//
//            if($shipment->shipment_status_id == 1 || $shipment->shipment_status_id == 12 ){
            $validation = Validator::make($request->all(), [

                'name' => 'required|string',
                'address' => 'required|string',
                'phone' => 'required|min:11|unique:clients,phone' . ($client->id ? ",$client->id" : ''),
                'phone_2' => 'nullable|min:11|unique:clients',
                'name_shipment' => 'required|string',
                'description' => 'nullable|string',
                'customer_code' => 'nullable|integer',
                'product_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'order_number' => 'nullable|integer',
                'count' => 'nullable|integer',
                'weight' => 'nullable|integer',
                'size' => 'nullable|string',
                'delivery_date' => 'nullable|date',
                'notes' => 'nullable|string',
//                'shipping_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'area_id' => 'required|exists:areas,id',
                'service_type_id' => 'required|exists:service_types,id',
                'sender_id' => 'required|exists:users,id',
                'store_id' => 'nullable|exists:stores,id',
                'shipment_status_id' => 'nullable|exists:shipment_status,id',
                'representative_id' => 'nullable|exists:representatives,id',
                'additional_service_id' => 'nullable|exists:additional_services,id',
                'reason_id' => 'nullable|exists:reasons,id',

            ]);
//            }else{
//                $validation = Validator::make($request->all(), [
//
//                    'name' => 'required|string',
//                    'address' => 'required|string',
//                    'phone' => 'required|min:11|unique:clients,phone' . ($client->id ? ",$client->id" : ''),
//                    'phone_2' => 'nullable|min:11|unique:clients',
//                    'name_shipment' => 'required|string',
//                    'description' => 'nullable|string',
//                    'customer_code' => 'nullable|integer',
//                    'product_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
//                    'order_number' => 'nullable|integer',
//                    'count' => 'nullable|integer',
//                    'weight' => 'nullable|integer',
//                    'size' => 'nullable|string',
//                    'delivery_date' => 'nullable|date',
//                    'notes' => 'nullable|string',
////                'shipping_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
//                    'area_id' => 'required|exists:areas,id',
//                    'service_type_id' => 'required|exists:service_types,id',
//                    'sender_id' => 'required|exists:users,id',
//                    'store_id' => 'required|exists:stores,id',
//                    'shipment_status_id' => 'required|exists:shipment_status,id',
//                    'representative_id' => 'required|exists:representatives,id',
//                    'additional_service_id' => 'nullable|exists:additional_services,id',
//                    'reason_id' => 'nullable|exists:reasons,id',
//
//                ]);
//            }


            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }

            //      =================update  photo  App\Models\Client

            $name = $client->photo;

            if ($request->hasFile('photo')) {
                if ($name !== null) {
                    unlink(public_path('/uploads/client/') . $name);
                }
                $file = $request->photo;
                $new_file = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/client', $new_file);
                $client->photo = $new_file;
            }

            //      =================update    App\Models\user

            $client->name = $request->name ?? $client->name;
            $client->email_2 = $request->email_2 ?? $client->email_2;
            $client->address = $request->address ?? $client->address;
            $client->phone = $request->phone ?? $client->phone;
            $client->phone_2 = $request->phone_2 ?? $client->phone_2;


            $client->update();
            //      ================= calculator  AdditionalService
            $additional_service = AdditionalService::where([['id', $request->additional_service_id],['admin_id',$this->idAdmin()]])->first();

            $price_additional_service = 0;
            if ($additional_service) {
                $price_additional_service = $additional_service->price;
            }


            //      ================= calculator  weight

            $weight = Weight::where('admin_id',$this->idAdmin())->first();

            $weight_company = WeightCompany::where([['company_id', $request->sender_id],['admin_id',$this->idAdmin()]])->first();
            $weight_price = 0;

            if ($weight_company) {
                if ($request->weight > $weight_company->limit) {
                    $weight_price = ($request->weight - $weight_company->limit) * $weight_company->price;
                }
            } else {
                if ($request->weight > $weight->limit) {
                    $weight_price = ($request->weight - $weight->limit) * $weight->price;
                }
            }

            //      ================= calculator  shipping price

            $shipping_area_price = ShippingAreaPrice::where([['area_id', $request->area_id],['admin_id',$this->idAdmin()]])->first();
            $company_shipping_area_price = CompanyShippingAreaPrice::where([['company_id', $request->sender_id], ['area_id', $request->area_id]])->first();
            $transportation_price_shipping = 0;

            if ($company_shipping_area_price) {
                $transportation_price_shipping = $company_shipping_area_price->transportation_price;
            } elseif (!$company_shipping_area_price) {
                $transportation_price_shipping = $shipping_area_price->transportation_price;
            }

            $shipping_price = $transportation_price_shipping + $weight_price + $price_additional_service;

            //      =================update    App\Models\user

            $shipment->name_shipment = $request->name_shipment ?? $shipment->name_shipment;
            $shipment->description = $request->description ?? $shipment->description;
            $shipment->customer_code = $request->customer_code ?? $shipment->customer_code;
            $shipment->product_price = $request->product_price ?? $shipment->product_price;
            $shipment->order_number = $request->order_number ?? $shipment->order_number;
            $shipment->shipping_price = $shipping_price;
            $shipment->weight = $request->weight ?? $shipment->weight;
            $shipment->count = $request->count ?? $shipment->count;
            $shipment->size = $request->size ?? $shipment->size;
            $shipment->notes = $request->notes ?? $shipment->notes;
            $shipment->delivery_date = $request->delivery_date ?? $shipment->delivery_date;
            $shipment->area_id = $request->area_id ?? $shipment->area_id;
            $shipment->service_type_id = $request->service_type_id ?? $shipment->service_type_id;
            $shipment->representative_id = $request->representative_id ?? $shipment->representative_id;
            $shipment->sender_id = $request->sender_id ?? $shipment->sender_id;
            $shipment->store_id = $request->store_id ?? $shipment->store_id;
            $shipment->shipment_status_id = $request->shipment_status_id ?? $shipment->shipment_status_id;
            $shipment->additional_service_id = $request->additional_service_id ?? $shipment->additional_service_id;
            $shipment->reason_id = $request->reason_id ?? $shipment->reason_id;
            $shipment->admin_id = $this->idAdmin()??$shipment->admin_id;


            $shipment->update();
            if ($shipment->shipment_status_id == 2) {

                $store_id = $shipment->store_id;
                $representative_id = $shipment->representative_id;
                if (!$this->calculateStatus2($shipment, $store_id, $representative_id)) {
                    return 0;
                }
            } elseif ($shipment->shipment_status_id == 3) {

                $store_id = $shipment->store_id;
                $representative_id = $shipment->representative_id;
                if (!$this->calculateStatus2($shipment, $store_id, $representative_id)) {
                    return 0;
                }
            } elseif ($shipment->shipment_status_id == 4) {

                $store_id = $shipment->store_id;
                $representative_id = $shipment->representative_id;
                if (!$this->calculateStatus2($shipment, $store_id, $representative_id)) {
                    return 0;
                }
            } elseif ($shipment->shipment_status_id == 5) {

                $store_id = $shipment->store_id;
                $representative_id = $shipment->representative_id;
                if (!$this->calculateStatus2($shipment, $store_id, $representative_id)) {
                    return 0;
                }
            } elseif ($shipment->shipment_status_id == 6) {

                $store_id = $shipment->store_id;
                $representative_id = $shipment->representative_id;
                if (!$this->calculateStatus2($shipment, $store_id, $representative_id)) {
                    return 0;
                }
            } elseif ($shipment->shipment_status_id == 7) {
                $store_id = $shipment->store_id;
                $representative_id = $shipment->representative_id;
                if (!$this->calculateStatus7($shipment, $store_id, $representative_id)) {
                    return 0;
                }
            } elseif ($shipment->shipment_status_id == 8) {
                $return_price = $shipment->return_price;
                $store_id = $shipment->store_id;
                $representative_id = $shipment->representative_id;
                if (!$this->calculateStatus8($shipment, $return_price, $store_id, $representative_id)) {
                    return 0;
                }
            } elseif ($shipment->shipment_status_id == 9) {

                $return_price = $shipment->return_price;
                $store_id = $shipment->store_id;
                $representative_id = $shipment->representative_id;
                if (!$this->calculateStatus9($shipment, $return_price, $store_id, $representative_id)) {
                    return 0;
                }

            } elseif ($shipment->shipment_status_id == 10) {
                $store_id = $shipment->store_id;
                $representative_id = $shipment->representative_id;
                if (!$this->calculateStatus10($shipment, $store_id, $representative_id)) {
                    return 0;
                }
            } elseif ($shipment->shipment_status_id == 11) {
                $store_id = $shipment->store_id;
                $representative_id = $shipment->representative_id;
                if (!$this->calculateStatus11($shipment, $store_id, $representative_id)) {
                    return 0;
                }
            }


            DB::commit();
            //        return response()->json($admin);
            return $this->returnData('shipment', $shipment, 'successfully');

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function update_shipment_representatives(Request $request)
    {
        DB::beginTransaction();



        try {
            foreach ($request->all() as $key => $value)
                $request->merge([$key => $value == "undefined" || $value == "null" ? null : $value]);
            $validation = Validator::make($request->all(), [

                'representative_id' => 'required|exists:representatives,id',
                // 'shipment_id.*' => 'required|exists:shipments,id',

            ]);

            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }

            foreach ($request->shipment_id as $shipment_id) {

                $RepresentativeAccountDetail = RepresentativeAccountDetail::where([
                    ['representative_account_id', NULL],
                    ['shipment_id', $shipment_id],
                    ['admin_id',$this->idAdmin()]
                ])->first();


                if ($RepresentativeAccountDetail) {

                    $shipment = Shipment::where('admin_id',$this->idAdmin())->find($shipment_id);
                    $shipment->update([

                        'representative_id' => $request->representative_id,

                    ]);

                } else {
                    $shipment = RepresentativeAccountDetail::where('admin_id',$this->idAdmin())->find($shipment_id);

                    if (!$shipment) {
                        $shipment = Shipment::where('admin_id',$this->idAdmin())->find($shipment_id);
                        if ($shipment) {
                            $shipment->update([
                                'representative_id' => $request->representative_id,
                            ]);
                        }

                    }
                }

            }
            DB::commit();
            return response()->json('successfully');


        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shipment = Shipment::where('admin_id',$this->idAdmin())->find($id);

        if (count($shipment->shipmenttransfer) > 0 || count($shipment->stock_detail) > 0 || count($shipment->company_shipment_details) > 0 || count($shipment->representative_account_detail) > 0) {
            return response()->json("no delete", 400);

        } else {

            $shipment->destroy($id);
            return response()->json('deleted successfully');
        }


    }
}
