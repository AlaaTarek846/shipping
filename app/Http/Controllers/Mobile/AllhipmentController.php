<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\AdditionalService;
use App\Models\Area;
use App\Models\CompanyShippingAreaPrice;
use App\Models\ServiceType;
use App\Models\Client;
use App\Models\Shipment;
use App\Models\Province;
use App\Models\ShipmentStatu;
use App\Models\ShippingAreaPrice;
use App\Models\Weight;
use App\Models\WeightCompany;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AllhipmentController extends Controller
{
    use GeneralTrait;

    //    Shipment status chart
    public function shipmentStatusChart()
    {
        $user_id = auth()->user()->id;
        $data = [];

        // count of return 8 / 9 / 10

        $return = Shipment::where([
            ['sender_id' , $user_id],
            ['shipment_status_id' , 8 ],
        ])->orWhere([
            ['sender_id' , $user_id],
            ['shipment_status_id' , 9 ],
        ])->orWhere([
            ['sender_id' , $user_id],
            ['shipment_status_id' , 10 ],
        ])->count();

        // count of under collection 4 / 5 / 6

        $under_collection = Shipment::where([
            ['sender_id' , $user_id],
            ['shipment_status_id' , 4 ],
        ])->orWhere([
            ['sender_id' , $user_id],
            ['shipment_status_id' , 5 ],
        ])->orWhere([
            ['sender_id' , $user_id],
            ['shipment_status_id' , 6 ],
        ])->count();

        // count of Pick-up has been received 3

        $Pick_up_has_been_received = Shipment::where([
            ['sender_id' , $user_id],
            ['shipment_status_id' , 3 ],
        ])->count();

        // count of Delivery failed 11
        $Delivery_failed = Shipment::where([
            ['sender_id' , $user_id],
            ['shipment_status_id' , 11 ],
        ])->count();

        // count of successful delivery 7
        $successful_delivery = Shipment::where([
            ['sender_id' , $user_id],
            ['shipment_status_id' , 7 ],
        ])->count();

        $data['return_shipment'] = $return;
        $data['under_collection'] = $under_collection;
        $data['Pick_up_has_been_received'] = $Pick_up_has_been_received;
        $data['Delivery_failed'] = $Delivery_failed;
        $data['successful_delivery'] = $successful_delivery;


        return $this->returnData('data', $data, 'successfully');
    }

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

    public function index_return()
    {
        $user_id = auth()->user()->id;

        $shipment = Shipment::where([
            ['sender_id' , $user_id],
            ['shipment_status_id' , 8 ],
        ])->orWhere([
            ['sender_id' , $user_id],
            ['shipment_status_id' , 9 ],
        ])->orWhere([
            ['sender_id' , $user_id],
            ['shipment_status_id' , 10 ],
        ])->orWhere([
            ['sender_id' , $user_id],
            ['shipment_status_id' , 11 ],
        ])->with('shipmentstatu')->get();


        return $this->returnData('shipment', $shipment, 'successfully');
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
//            return $request;

            //      =================validate on Table  Models User and Client

            $validation = Validator::make($request->all(), [

                'data_client' => 'required|array',
                'data_client.*.name' => 'required|string',
                'data_client.*.address' => 'required|string',
                'data_client.*.google_location' => 'nullable|string',
                'data_client.*.email_2' => 'nullable|email|unique:clients',
                'data_client.*.phone' => 'required|min:11|unique:clients',
                'data_client.*.phone_2' => 'nullable|min:11|unique:clients',
                'data_client.*.name_shipment' => 'required|string',
                'data_client.*.description' => 'nullable|string',
                'data_client.*.customer_code' => 'nullable|integer',
                'data_client.*.product_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'data_client.*.order_number' => 'nullable|integer',
                'data_client.*.count' => 'nullable|integer',
                'data_client.*.delivery_date' => 'nullable|date',
//                'data_client.*.shipping_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'data_client.*.weight' => 'nullable|integer',
                'data_client.*.size' => 'nullable|string',
                'data_client.*.notes' => 'nullable|string',
                'data_client.*.area_id' => 'required|exists:areas,id',
                'data_client.*.service_type_id' => 'required|exists:service_types,id',
                'data_client.*.additional_service_id' => 'nullable|exists:additional_services,id',
//                'data_client.*.store_id' => 'nullable|exists:stores,id',
//                'data_client.*.shipment_status_id' => 'nullable|exists:shipment_status,id',
//                'data_client.*.representative_id' => 'nullable|exists:representatives,id',

            ]);
            if ($validation->fails()) {
                return $this->returnError('errors', $validation->errors());
            }

            $user_id = auth()->user()->id;


            foreach ($request->data_client as $data_client) {

                //      =================App\Models\Client
                $client = Client::where('phone', $data_client['phone'])->first();

                if ($client){

                    $client->update([
                        'name' => $data_client['name'],
                        'address' => $data_client['address'],
                        'google_location' => $data_client['google_location'],
                        'phone' => $data_client['phone'],
                        'email_2' => $data_client['email_2'],
                        'phone_2' => $data_client['phone_2'],
                    ]);

                }else{

                    $client = Client::create([

                        'name' => $data_client['name'],
                        'address' => $data_client['address'],
                        'email_2' => $data_client['email_2'],
                        'google_location' => $data_client['google_location'],
                        'phone' => $data_client['phone'],
                        'phone_2' => $data_client['phone_2'],

                    ]);

                }

                //      ================= calculator  AdditionalService
                $additional_service = AdditionalService::where('id',$data_client['additional_service_id'])->first();
                $price_additional_service =0;
                if($additional_service){
                    $price_additional_service =  $additional_service->price ;
                }


                //      ================= calculator  weight

                $weight = Weight::first();
                $weight_company = WeightCompany::where('company_id',$user_id)->first();
                $weight_price = 0;

                if ($weight_company){
                    if($request->weight > $weight_company->limit){
                        $weight_price = ($request->weight - $weight_company->limit ) * $weight_company->price;
                    }
                }else{
                    if($request->weight > $weight->limit){
                        $weight_price = ($request->weight - $weight->limit ) * $weight->price;
                    }
                }

                //      ================= calculator  shipping price

                $shipping_area_price = ShippingAreaPrice::where('area_id',$data_client['area_id'])->first();

                $company_shipping_area_price = CompanyShippingAreaPrice::where([['company_id',$user_id],['area_id',$data_client['area_id']]])->first();

                $transportation_price_shipping = 0;

                if ($company_shipping_area_price !== null){

                    $transportation_price_shipping =  $company_shipping_area_price->transportation_price;
                }elseif($company_shipping_area_price){
                    $transportation_price_shipping =  $shipping_area_price->transportation_price;

                }
//                return $transportation_price_shipping;


                $shipping_price = $transportation_price_shipping + $weight_price + $price_additional_service;

//                return $weight_price;


                //      =================App\Models\Shipment

                $shipment = Shipment::create([
                    'client_id' => $client->id,
                    'name_shipment' => $data_client['name_shipment']??null,
                    'description' => $data_client['description']??null,
                    'customer_code' => $data_client['customer_code']??null,
                    'product_price' => $data_client['product_price']??null,
                    'order_number' => $data_client['order_number']??null,
                    'shipping_price' => $shipping_price,
                    'weight' => $data_client['weight']??null,
                    'size' => $data_client['size']??null,
                    'notes' => $data_client['notes']??null,
                    'count' => $data_client['count']??null,
                    'delivery_date' => $data_client['delivery_date']??null,
                    'area_id' => $data_client['area_id']??null,
                    'service_type_id' => $data_client['service_type_id']??null,
                    'representative_id' => $data_client['representative_id']??null,
                    'store_id' => $data_client['store_id']??null,
                    'shipment_status_id' => $data_client['shipment_status_id']??1,
                    'additional_service_id' => $data_client['additional_service_id']??null,
                    'sender_id' => $user_id,

                ]);

            };

            DB::commit();

            return response()->json("successfully");

//            return $this->returnData('shipment',"" , 'successfully');

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
        $shipment = Shipment::with('area', 'client', 'representative', 'serviceType','shipmentstatu','additionalservice', 'store', 'user')->findOrFail($id);

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

            //      =================update validate on Table  Models User and Client

            if ($request->shipment_status_id == 1){

                $shipment = Shipment::findOrFail($id);
                $client = Client::find($shipment->client_id);
                $validation = Validator::make($request->all(), [

                    'name' => 'required|string',
                    'address' => 'required|string',
                    'phone' => 'required|min:11|unique:clients,phone' .($client->id ? ",$client->id" : ''),
                    'phone_2' => 'nullable|min:11|unique:clients,phone_2' .($client->id ? ",$client->id" : ''),
                    'email_2' => 'email|unique:clients,email_2' .($client->id ? ",$client->id" : ''),
                    'name_shipment' => 'required|string',
                    'description' => 'nullable|string',
                    'customer_code' => 'nullable|integer',
                    'collection_amount' => 'nullable|integer',
                    'order_number' => 'nullable|integer',
                    'weight' => 'nullable|string',
                    'count' => 'nullable|integer',
                    'delivery_date' => 'nullable|date_format:Y/m/d|after:yesterday',
                    'size' => 'nullable|string',
                    'notes' => 'nullable|string',
//                'shipping_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                    'area_id'  =>  'required|exists:areas,id',
                    'service_type_id'  =>  'required|exists:service_types,id',
//                'sender_id'  =>  'required|exists:users,id',


                ]);
                if ($validation->fails()) {
                    return $this->returnError('errors', $validation->errors());
                }
                $user_id = auth()->user()->id;

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

                //      =================update    App\Models\Client


                $client->name = $request->name;
                $client->email_2 = $request->email_2;
                $client->address = $request->address;
                $client->phone = $request->phone;
                $client->phone_2 = $request->phone_2;

                $client->update();

                //      =================update    App\Models\Shipment
                //      ================= calculator  AdditionalService
                $additional_service = AdditionalService::where('id', $request->additional_service_id)->first();

                $price_additional_service = 0;
                if ($additional_service) {
                    $price_additional_service = $additional_service->price;
                }


                //      ================= calculator  weight

                $weight = Weight::first();

                $weight_company = WeightCompany::where('company_id', $user_id)->first();
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
                $company_shipping_area_price = CompanyShippingAreaPrice::where([['company_id', $user_id], ['area_id', $request->area_id]])->first();
                $transportation_price_shipping = 0;

                if ($company_shipping_area_price) {
                    $transportation_price_shipping = $company_shipping_area_price->transportation_price;
                } elseif ($company_shipping_area_price) {
                    $transportation_price_shipping = $shipping_area_price->transportation_price;
                }

                $shipping_price = $transportation_price_shipping + $weight_price + $price_additional_service;

                $shipment->name_shipment = $request->name_shipment??$shipment->name_shipment;
                $shipment->description = $request->description??$shipment->description;
                $shipment->customer_code = $request->customer_code??$shipment->customer_code;
                $shipment->product_price = $request->product_price??$shipment->product_price;
                $shipment->order_number = $request->order_number??$shipment->order_number;
                $shipment->shipping_price = $shipping_price;
                $shipment->weight = $request->weight??$shipment->weight;
                $shipment->delivery_date = $request->delivery_date??$shipment->delivery_date;
                $shipment->size = $request->size??$shipment->size;
                $shipment->notes = $request->notes??$shipment->notes;
                $shipment->area_id = $request->area_id??$shipment->area_id;
                $shipment->service_type_id = $request->service_type_id??$shipment->service_type_id;
                $shipment->shipment_status_id = $request->shipment_status_id??$shipment->shipment_status_id;
                $shipment->representative_id = $request->representative_id??$shipment->representative_id ;
                $shipment->sender_id = $user_id;

                $shipment->update();

                DB::commit();
                //        return response()->json($admin);
                return $this->returnData('shipment', $shipment, 'successfully');

            }else{
                return  response()->json(['Message'=>['Editing is not allowed']],422);
            }



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
        $shipment = Shipment::find($id);

        if (count($shipment->shipmenttransfer) > 0 || count($shipment->stock_detail) > 0 || count($shipment->company_shipment_details) > 0 || count($shipment->representative_account_detail) > 0) {
            return response()->json("no delete", 400);

        } else {

            $shipment->destroy($id);
            return response()->json('deleted successfully');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function province_area()
    {
        $province = Province::with('areas')->get();
        return $this->returnData('province', $province, 'successfully');
    }

    public function area_shipment()
    {
        $provinces = Province::all();

        $data = [];
        $data_area = [];

        foreach ($provinces as $index=>$province)
        {
            $length = 0;
            foreach ($province->areas as $area){
                if(count($area->shipping_area_price) > 0){

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function service_type()
    {
        $service_type = ServiceType::all();
        return $this->returnData('service_type', $service_type, 'successfully');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shipment_statu()
    {
        $shipment_statu = ShipmentStatu::all();
        return $this->returnData('shipment_statu', $shipment_statu, 'successfully');
    }


    public function additionalService()
    {
        $additional_service  = AdditionalService::all();

        return $this->returnData('additional_service', $additional_service, 'successfully');
    }


}
