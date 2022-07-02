<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AdditionalService;
use App\Models\Client;
use App\Models\CompanyShippingAreaPrice;
use App\Models\Shipment;
use App\Models\ShippingAreaPrice;
use App\Models\Weight;
use App\Models\WeightCompany;
use App\Traits\GeneralTrait;
use App\Traits\ShipmentTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CompanyShipmentController extends Controller
{
    use GeneralTrait;
    use ShipmentTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $shipment = Shipment::where('sender_id',$user_id)->with('area', 'client', 'representative', 'serviceType','shipmentstatu','additionalservice', 'store', 'user')->latest()->paginate(15);

        return $this->returnData('shipment', $shipment, 'successfully');
    }
//    public function index(Request $request)
//    {
//        foreach ($request->all() as $key => $value)
//            $request->merge([$key => $value == "'undefined'" || $value == "'null'" || $value == "null" || $value == "undefined" ? null : $value]);
////        return $request;
//        $data = [];
//
//        $user_id = auth()->user()->id;
//        $shipment = $this->search($user_id,$request);
//
//        $count_shipment = Shipment::where('sender_id',$user_id)->count();
//        $total_cod = Shipment::where('sender_id',$user_id)->get()->sum('total_shipment');
//
//        $data['shipment'] = $shipment;
//        $data['count_shipment'] = $count_shipment;
//        $data['total_cod'] = $total_cod;
//
//        return $this->returnData('data', $data, 'successfully');
//    }

   //الشخنات الخالية
    public function getshipmentcurrent(){

        $user_id = auth()->user()->id;

//        return $user_id;
        $shipment_current = Shipment::
        where([
            ['sender_id',$user_id],
            ['shipment_status_id',1],
        ])->orWhere([
            ['sender_id',$user_id],
            ['shipment_status_id',2],
        ])->orWhere([
            ['sender_id',$user_id],
            ['shipment_status_id',3],
        ])->orWhere([
            ['sender_id',$user_id],
            ['shipment_status_id',4],
        ])->orWhere([
            ['sender_id',$user_id],
            ['shipment_status_id',5],
        ])->with('area', 'client', 'representative', 'serviceType','shipmentstatu','additionalservice', 'store', 'user')->latest()->paginate(2);

        return $this->returnData('shipment_current', $shipment_current, 'successfully');

    }
    //الشخنات المرسلة
    public function getshipmentsent(){

        $user_id = auth()->user()->id;

        $shipment_sent = Shipment::
        where([
            ['sender_id',$user_id],
            ['shipment_status_id',6],
        ])->with('area', 'client', 'representative', 'serviceType','shipmentstatu','additionalservice', 'store', 'user')->latest()->paginate(2);

        return $this->returnData('shipment_sent', $shipment_sent, 'successfully');

    }

    //الشخنات المنتهية
    public function getshipmentfinished(){

        $user_id = auth()->user()->id;

//        return $user_id;
        $shipment_finished = Shipment::
        where([
            ['sender_id',$user_id],
            ['shipment_status_id',7],
        ])->orWhere([
            ['sender_id',$user_id],
            ['shipment_status_id',8],
        ])->orWhere([
            ['sender_id',$user_id],
            ['shipment_status_id',9],
        ])->orWhere([
            ['sender_id',$user_id],
            ['shipment_status_id',10],
        ])->orWhere([
            ['sender_id',$user_id],
            ['shipment_status_id',11],
        ])->with('area', 'client', 'representative', 'serviceType','shipmentstatu','additionalservice', 'store', 'user')->latest()->paginate(2);

        return $this->returnData('shipment_finished', $shipment_finished, 'successfully');

    }


    //الشخنات المرسلة  6

    public function searchdatecurrent(Request $request)
    {

        if ($request->number_id > 0 ){

            $validation = Validator::make($request->all(), [

                'number_id' => 'required|exists:shipments,id',

            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }
            $user_id = auth()->user()->id;
            $get_all_Shipment = Shipment::
            where([
                ['id','=',$request->number_id],
                ['sender_id',$user_id],
                ['shipment_status_id',1]
            ])->orWhere([
                ['id','<=',$request->number_id],
                ['sender_id',$user_id],
                ['shipment_status_id',2]
            ])->orWhere([
                ['id','=',$request->number_id],
                ['sender_id',$user_id],
                ['shipment_status_id',3]
            ])->orWhere([
                ['id','=',$request->number_id],
                ['sender_id',$user_id],
                ['shipment_status_id',4]
            ])->orWhere([
                ['id','=',$request->number_id],
                ['sender_id',$user_id],
                ['shipment_status_id',5]
            ])->orWhere([
                ['id','=',$request->number_id],
                ['sender_id',$user_id],
                ['shipment_status_id',6]
            ])->first();

        }else{

            $validation = Validator::make($request->all(), [

                'start_date' => 'required|date',
                'end_date' => 'required|date',
            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }

            $user_id = auth()->user()->id;

            $start = Carbon::parse($request->start_date);
            $end = Carbon::parse($request->end_date);
            $get_all_Shipment = Shipment::
            where([
                ['sender_id',$user_id],
                ['shipment_status_id',1]
            ])->orWhere([
                ['sender_id',$user_id],
                ['shipment_status_id',2]
            ])->orWhere([
                ['sender_id',$user_id],
                ['shipment_status_id',3]
            ])->orWhere([
                ['sender_id',$user_id],
                ['shipment_status_id',4]
            ])->orWhere([
                ['sender_id',$user_id],
                ['shipment_status_id',5]
            ])
                ->whereDate('created_at','<=',$end)
                ->whereDate('created_at','>=',$start)
                ->get();

        }




        return $this->returnData('search_date', $get_all_Shipment, 'successfully');

    }

    public function searchdatesent(Request $request)
    {

        if ($request->number_id > 0 ){

            $validation = Validator::make($request->all(), [

                'number_id' => 'required|exists:shipments,id',

            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }
            $user_id = auth()->user()->id;
            $get_all_Shipment = Shipment::
            where([
                ['id','=',$request->number_id],
                ['sender_id',$user_id],
                ['shipment_status_id',6]
            ])->first();

        }else{

            $validation = Validator::make($request->all(), [

                'start_date' => 'required|date',
                'end_date' => 'required|date',
            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }

            $user_id = auth()->user()->id;

            $start = Carbon::parse($request->start_date);
            $end = Carbon::parse($request->end_date);
            $get_all_Shipment = Shipment::
            where([
                ['sender_id',$user_id],
                ['shipment_status_id',6]
            ])
                ->whereDate('created_at','<=',$end)
                ->whereDate('created_at','>=',$start)
                ->get();

        }




        return $this->returnData('search_date', $get_all_Shipment, 'successfully');

    }

    public function searchdatefinished(Request $request)
    {

        if ($request->number_id > 0 ){

            $validation = Validator::make($request->all(), [

                'number_id' => 'required|exists:shipments,id',

            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }
            $user_id = auth()->user()->id;
            $get_all_Shipment = Shipment::
            where([
                ['id','=',$request->number_id],
                ['sender_id',$user_id],
                ['shipment_status_id',7]
            ])->orWhere([
                ['id','=',$request->number_id],
                ['sender_id',$user_id],
                ['shipment_status_id',8]
            ])->orWhere([
                ['id','=',$request->number_id],
                ['sender_id',$user_id],
                ['shipment_status_id',9]
            ])->orWhere([
                ['id','=',$request->number_id],
                ['sender_id',$user_id],
                ['shipment_status_id',10]
            ])->orWhere([
                ['id','=',$request->number_id],
                ['sender_id',$user_id],
                ['shipment_status_id',11]
            ])->first();

        }else{

            $validation = Validator::make($request->all(), [

                'start_date' => 'required|date',
                'end_date' => 'required|date',
            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }

            $user_id = auth()->user()->id;

            $start = Carbon::parse($request->start_date);
            $end = Carbon::parse($request->end_date);
            $get_all_Shipment = Shipment::
            where([
                ['sender_id',$user_id],
                ['shipment_status_id',7]
            ])->orWhere([
                ['sender_id',$user_id],
                ['shipment_status_id',8]
            ])->orWhere([
                ['sender_id',$user_id],
                ['shipment_status_id',9]
            ])->orWhere([
                ['sender_id',$user_id],
                ['shipment_status_id',10]
            ])->orWhere([
                ['sender_id',$user_id],
                ['shipment_status_id',11]
            ])
                ->whereDate('created_at','<=',$end)
                ->whereDate('created_at','>=',$start)
                ->get();

        }

        return $this->returnData('search_date', $get_all_Shipment, 'successfully');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
//                'shipping_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'area_id' => 'required|exists:areas,id',
                'service_type_id' => 'required|exists:service_types,id',
//                'sender_id' => 'required|exists:users,id',
                'store_id' => 'nullable|exists:stores,id',
                'shipment_status_id' => 'nullable|exists:shipment_status,id',
                'representative_id' => 'nullable|exists:representatives,id',
                'additional_service_id' => 'nullable|exists:additional_services,id',
            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }

            //      =================upload  photo  App\Models\Client
            $user_id = auth()->user()->id;

            if ($request->hasFile('photo')) {
                $file = $request->photo;
                $new_file = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/client', $new_file);
            } else {
                $new_file = null;
            }
//      =================App\Models\Client

            $client = Client::create([

                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'google_location' => $request->google_location,
                'phone' => $request->phone,
                'phone_2' => $request->phone_2,
                'photo' => $new_file,

            ]);
            //      ================= calculator  AdditionalService
            $additional_service = AdditionalService::where('id', $request->additional_service_id)->first();

            $price_additional_service = 0;
            if ($additional_service) {
                $price_additional_service = $additional_service->price;
            }


            //      ================= calculator  weight

            $weight = Weight::first();

            $weight_company = WeightCompany::where('company_id', $request->sender_id)->first();
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

            $shipping_area_price = ShippingAreaPrice::where('area_id', $request->area_id)->first();
            $company_shipping_area_price = CompanyShippingAreaPrice::where([['company_id', $request->sender_id], ['area_id', $request->area_id]])->first();
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
                'sender_id' => $user_id,
                'store_id' => $request->store_id,
                'additional_service_id' => $request->additional_service_id,

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id = auth()->user()->id;

        $shipment = Shipment::where('sender_id',$user_id)->with('area', 'client', 'representative', 'serviceType','shipmentstatu','additionalservice', 'store', 'user')->findOrFail($id);

        return $this->returnData('shipment', $shipment, 'successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//      if($request->shipment_status_id == 1){
          DB::beginTransaction();

          try {
              foreach ($request->all() as $key => $value)
                  $request->merge([$key => $value == "undefined" || $value == "null" ? null : $value]);

              //      =================update validate on Table  Models User and Client
              $shipment = Shipment::findOrFail($id);
              $client = Client::find($shipment->client_id);
//
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
//                'sender_id' => 'required|exists:users,id',
                  'store_id' => 'nullable|exists:stores,id',
                  'shipment_status_id' => 'nullable|exists:shipment_status,id',
                  'representative_id' => 'nullable|exists:representatives,id',
                  'additional_service_id' => 'nullable|exists:additional_services,id',

              ]);
              $user_id = auth()->user()->id;



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
              $additional_service = AdditionalService::where('id', $request->additional_service_id)->first();
              $price_additional_service = 0;
              if ($additional_service) {
                  $price_additional_service = $additional_service->price;
              }


              //      ================= calculator  weight

              $weight = Weight::first();

              $weight_company = WeightCompany::where('company_id', $request->sender_id)->first();
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

              $shipping_area_price = ShippingAreaPrice::where('area_id', $request->area_id)->first();
              $company_shipping_area_price = CompanyShippingAreaPrice::where([['company_id', $request->sender_id], ['area_id', $request->area_id]])->first();
              $transportation_price_shipping = 0;

              if ($company_shipping_area_price) {
                  $transportation_price_shipping = $company_shipping_area_price->transportation_price;
                  return $transportation_price_shipping;
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
              $shipment->sender_id = $user_id;
              $shipment->store_id = $request->store_id ?? $shipment->store_id;
              $shipment->shipment_status_id = $request->shipment_status_id ?? $shipment->shipment_status_id;
              $shipment->additional_service_id = $request->additional_service_id ?? $shipment->additional_service_id;

              $shipment->update();



              DB::commit();
              //        return response()->json($admin);
              return $this->returnData('shipment', $shipment, 'successfully');

          } catch (\Exception $e) {
              DB::rollback();

              return response()->json(['error' => $e->getMessage()], 500);
          }
//      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function search($user_id,$request)
//    {
//        return Shipment::where('sender_id',$user_id)
//            ->where(function ($q) use ($request) {
//                $q->when($request->date, function ($q) {
//                    $q->whereDate('created_at', now()->format('Y-m-d'));
//                });
//            })
//            ->where(function ($q) use ($request) {
//                $q->when($request->start_date && $request->end_date, function ($q) use ($request) {
//                    $q->whereDate('created_at', ">=", $request->start_date)
//                        ->whereDate('created_at', "<=", $request->end_date);
//
//                });
//            })->where(function ($q) use ($request) {
//                $q->when($request->shipment_status_id, function ($q) use ($request) {
//                    $q->where('shipment_status_id', $request->shipment_status_id);
//                });
//            })->where(function ($q) use ($request) {
//                $q->when($request->representative_id, function ($q) use ($request) {
//                    $q->where('representative_id', $request->representative_id);
//                });
//            })
//            ->where(function ($q) use ($request) {
//                $q->when($request->search, function ($q) use ($request) {
//                    $q
//                        ->whereHas('user', function ($q) use ($request) {
//                            $q->whereHas('company', function ($q) use ($request) {
//                                $q->where('name', 'like', '%' . $request->search . "%");
//                            });
//                        })
//                        ->orWhereHas('client', function ($q) use ($request) {
//                            $q->where('name', 'like', '%' . $request->search . "%")
//                                ->orWhere('phone', 'like', '%' . $request->search . "%");
//                        })
//                        ->orWhereHas('area', function ($q) use ($request) {
//                            $q->where('name', 'like', '%' . $request->search . "%");
//                        })
//                        ->orWhereHas('shipmentstatu', function ($q) use ($request) {
//                            $q->where('name', 'like', '%' . $request->search . "%");
//                        })
//                        ->orWhereHas('serviceType', function ($q) use ($request) {
//                            $q->where('type', 'like', '%' . $request->search . "%");
//                        })->orWhere('name_shipment', 'like', '%' . $request->search . "%");
//                });
//
//            })
//            ->latest()->paginate(20);
//    }


}
