<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Area;
use App\Models\CompanyShippingAreaPrice;
use App\Models\ShippingAreaPrice;
use App\Models\Weight;
use App\Models\WeightCompany;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Imports\ImportShipment;
use App\Exports\ExportShipment;
use App\Models\Shipment;
use App\Models\Client;
use App\Models\ImportShipmentt;
use App\Models\ServiceType;
use App\Models\AdditionalService;
use Validator;


class ImportExportController extends Controller
{
    use GeneralTrait;

    public function importView(Request $request)
    {
        return view('importFile');
    }

    public function import(Request $request, $user_id)
    {
        DB::beginTransaction();

        try {

            $validation = \Illuminate\Support\Facades\Validator::make($request->all(), [

                'file' => 'required',
            ]);

            if ($validation->fails()) {
                return $this->returnError('errors', $validation->errors());
            }

            // $data = Excel::toArray([],$request->file('file'));
            // return $data;

            Excel::import(new ImportShipment, $request->file('file'));

            $importshipmentt = ImportShipmentt::where('end', 0)->get();
            // return $importshipmentt;


            if ($importshipmentt->count() > 0) {

                foreach ($importshipmentt as $import) {


                    $client = Client::where('phone', $import['phone'])->first();

                    if ($client) {

                        $client->update([
                            'name' => $import['client_name'],
                            'address' => $import['address'],
                            'phone' => $import['phone'],
                            'phone_2' => $import['phone_2'],
                            'email_2' => $import['email'],
                        ]);

                    } else {

                        $client = Client::create([
                            'name' => $import['client_name'],
                            'address' => $import['address'],
                            'phone' => $import['phone'],
                            'phone_2' => $import['phone_2'],
                            'email_2' => $import['email'],
                        ]);

                    }


                    $area = Area::where('name', $import['area'])->first();

                    $service = ServiceType::where('type', $import['service_types'])->first();
//                    return $service;

                    if ($import['additional_service'] != null){

                        $additional_service_type = AdditionalService::where('type', $import['additional_service'])->first()->id;

                    }else{

                        $additional_service_type = null;
                    }

                    //      ================= calculator  AdditionalService
                    $additional_service = AdditionalService::where('type',$import['additional_service'])->first();

                    $price_additional_service =0;
                    if($additional_service){
                        $price_additional_service =  $additional_service->price ;
                    }


                    //      ================= calculator  weight

                    $weight = Weight::first();


                    $weight_company = WeightCompany::where('company_id',$user_id)->first();
                    $weight_price = 0;

                    if ($weight_company){
                        if($import['weight'] > $weight_company->limit){
                            $weight_price = ($import['weight'] - $weight_company->limit ) * $weight_company->price;
                        }
                    }else{
                        if($import['weight'] > $weight->limit){
                            $weight_price = ($import['weight'] - $weight->limit ) * $weight->price;
                        }
                    }

//                    return $weight_price;

                    //      ================= calculator  shipping price

                    $shipping_area_price = ShippingAreaPrice::where('area_id',$area->id)->first();

                    $company_shipping_area_price = CompanyShippingAreaPrice::where([['company_id',$user_id],['area_id',$area->id]])->first();

                    $transportation_price_shipping = 0;

                    if ($company_shipping_area_price !== null){

                        $transportation_price_shipping =  $company_shipping_area_price->transportation_price;
                    }else{
                        $transportation_price_shipping =  $shipping_area_price->transportation_price;

                    }

//                return $transportation_price_shipping;


                    $shipping_price = $transportation_price_shipping + $weight_price + $price_additional_service;



                    Shipment::create([

                        'client_id' => $client->id,
                        'name_shipment' => $import['name_product'],
                        'description' => $import['description_product'],
                        'customer_code' => $import['client_code'],
                        'product_price' => $import['price'],
                        'order_number' => $import['order_number'],
                        'weight' => $import['weight'],
                        'size' => $import['size'],
                        'count' => $import['count'],
                        'notes' => $import['notes'],
                        'delivery_date' => $import['delivery_date'],
                        'area_id' => $area->id,
                        'service_type_id' => $service->id,
                        'additional_service_id' => $additional_service_type,
                        'sender_id' => $user_id,
                        'shipment_status_id' =>1,
                        'shipping_price' => $shipping_price,


                    ]);


                    $import->update(['end'=>1]);

                }

            }

            DB::commit();
//            return 'successfully';

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function exportUsers(Request $request)
    {
        return Excel::download(new ExportShipment, 'shipments.xlsx');
    }
}
