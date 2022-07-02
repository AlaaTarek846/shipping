<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AdditionalService;
use App\Models\Area;
use App\Models\Client;
use App\Models\CompanyShippingAreaPrice;
use App\Models\Province;
use App\Models\ServiceType;
use App\Models\Shipment;
use App\Models\ShippingAreaPrice;
use App\Models\UserApiK;
use App\Models\Weight;
use App\Models\WeightCompany;
use App\Traits\GeneralTrait;
use App\Traits\ShipmentTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    use GeneralTrait;
    use ShipmentTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validation =Validator::make($request->all(),[
            'usre_api_k' => 'required|exists:user_api_k_s,api_k',
        ]);
        if ($validation->fails())
        {
            return $this->returnError('errors', $validation->errors());
        }
        $API_K = UserApiK::where('api_k',$request->usre_api_k)->first();
        if($API_K){
            $Shipment = Shipment::where('sender_id',$API_K->user_id)->get();
            return $this->returnData('Shipment', $Shipment, 'successfully');


        }else{
            return response()->json(["error"=>'Not Fount User Api k']);

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

                'api_k' => 'required|exists:user_api_k_s,api_k',
                'client_name' => 'required|string',
                'client_address' => 'required|string',
                'phone' => 'required|min:11|unique:clients',
                'client_email' => 'nullable|regex:/(.+)@(.+)\.(.+)/i',

                'customer_code' => 'nullable|integer',
                'shipment_product' => 'required|string',
                'shipment_description' => 'nullable|string',
                'order_number' => 'nullable|integer',
                'product_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'shipment_weight' => 'nullable|integer',
                'shipment_size' => 'nullable|string',
                'product_count' => 'nullable|integer',
                'notes' => 'nullable|string',
                'delivery_date_shipment' => 'nullable|date',
                'area_id' => 'required|exists:areas,id',
                'service_type_id' => 'required|exists:service_types,id',
            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }



            //      =================App\Models\Client

            $client = Client::create([

                'name' => $request->client_name,
                'email_2' => $request->client_email,
                'address' => $request->client_address,
                'phone' => $request->phone,

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
            $user_ApiK = UserApiK::where('api_k',$request->api_k)->first();


            $shipment = Shipment::create([
                'client_id' => $client->id,
                'customer_code' => $request->customer_code,
                'name_shipment' => $request->shipment_product,
                'description' => $request->shipment_description,
                'order_number' => $request->order_number,
                'product_price' => $request->product_price,
                'weight' => $request->shipment_weight,
                'size' => $request->shipment_size,
                'count' => $request->product_count,
                'delivery_date' => $request->delivery_date_shipment,
                'notes' => $request->notes,
                'shipping_price' => $shipping_price,
                'area_id' => $request->area_id,
                'service_type_id' => $request->service_type_id,
                'shipment_status_id' => 1,
                'sender_id' => $user_ApiK->user_id,


            ]);
            $shipment->client;


            DB::commit();


            return $this->returnData('shipment', $shipment, 'successfully');

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $UserApiK = UserApiK::findOrFail($id);
        $UserApiK->update([
            'api_k' =>Str::random(50),

        ]);

        return $this->returnData('UserApiK', $UserApiK, 'successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function api_area_shipment()
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

    public function api_service_type()
    {
        $service_type = ServiceType::all();
        return $this->returnData('service_type', $service_type, 'successfully');
    }



}
