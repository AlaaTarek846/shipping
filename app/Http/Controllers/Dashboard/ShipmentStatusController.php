<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\ShipmentStatu;
use App\Models\ShippingAreaPrice;
use App\Traits\GeneralTrait;
use App\Traits\NotificationTrait;
use App\Traits\ShipmentTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ShipmentStatusController extends Controller
{
    use GeneralTrait;
    use ShipmentTrait;
    use NotificationTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipment_status  = ShipmentStatu::all();

        return $this->returnData('shipment_status', $shipment_status, 'successfully');
    }

    // change shipments status
    public function changeShipmentsStatus(Request $request){
        $validation = Validator::make($request->all(), [
            'shipment_status_id'  =>  'required|exists:shipment_status,id',
            'shipment_id'  =>  'required|array|exists:shipments,id',

        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 422);
        }

        if ($request->shipment_status_id == 1){
            foreach ($request->shipment_id as $shipment_id){
                $shipment = Shipment::find($shipment_id);
                if (!$this->calculateStatus1($shipment)){
                    return 0;
                }
            }
        }elseif ($request->shipment_status_id == 2) {
            $validation = Validator::make($request->all(), [
                'store_id'  =>  'required|exists:stores,id',
                'representative_id'  =>  'required|exists:representatives,id',
            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }
            $store_id = $request->store_id;
            $representative_id = $request->representative_id;
            foreach ($request->shipment_id as $shipment_id) {
                $shipment = Shipment::find($shipment_id);

                if (!$this->calculateStatus2($shipment,$store_id,$representative_id)) {
                    return 0;
                }
                //send notification
                $tokens = [];
                $tokens[] = $shipment->user->token;
                $title = "Shipping";

                $body = " (".$shipment->shipmentstatu->name.")     موبايل ".$shipment->user->company->phone."   الحالة   ".$shipment->user->company->name."  عنوان    ".$shipment->user->company->address."  اسم الشركة  ";
                $request =  $shipment->representative_id;
                //02-  اشعار بوصول الشحنه رقم كذا ....... الى العميل اسمه كذا ........... رقم موبايل كذا .............  وحالة الشحنة ( مرتجع جزئي مسدد قيمة الشحن – مرتجع جزئي غير مسدد قيمة الشحن - ................ الخ )


                $this->notification($tokens,$body,$title,$request);

            }
        }elseif ($request->shipment_status_id == 3) {
            $validation = Validator::make($request->all(), [
                'store_id'  =>  'required|exists:stores,id',
                'representative_id'  =>  'required|exists:representatives,id',
            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }
            $store_id = $request->store_id;
            $representative_id = $request->representative_id;
            foreach ($request->shipment_id as $shipment_id) {
                $shipment = Shipment::find($shipment_id);

                if (!$this->calculateStatus3($shipment,$store_id,$representative_id)) {
                    return 0;
                }
            }
        }elseif ($request->shipment_status_id == 4) {
            $validation = Validator::make($request->all(), [
                'store_id'  =>  'required|exists:stores,id',
                'representative_id'  =>  'required|exists:representatives,id',
            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }
            $store_id = $request->store_id;
            $representative_id = $request->representative_id;
            foreach ($request->shipment_id as $shipment_id) {
                $shipment = Shipment::find($shipment_id);

                if (!$this->calculateStatus4($shipment,$store_id,$representative_id)) {
                    return 0;
                }
            }
        }elseif ($request->shipment_status_id == 5) {
            $validation = Validator::make($request->all(), [
                'store_id'  =>  'required|exists:stores,id',
                'representative_id'  =>  'required|exists:representatives,id',
            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }
            $store_id = $request->store_id;
            $representative_id = $request->representative_id;
            foreach ($request->shipment_id as $shipment_id) {
                $shipment = Shipment::find($shipment_id);

                if (!$this->calculateStatus5($shipment,$store_id,$representative_id)) {
                    return 0;
                }
            }
        }elseif ($request->shipment_status_id == 6) {
            $validation = Validator::make($request->all(), [
                'store_id'  =>  'required|exists:stores,id',
                'representative_id'  =>  'required|exists:representatives,id',
            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }
            $store_id = $request->store_id;
            $representative_id = $request->representative_id;
            foreach ($request->shipment_id as $shipment_id) {
                $shipment = Shipment::find($shipment_id);

                if (!$this->calculateStatus6($shipment,$store_id,$representative_id)) {
                    return 0;
                }

                //send notification
                $tokens = [];
                $tokens[] = $shipment->user->token;
                $title = "Shipping";
                $body =  " ملاحظات ".$shipment->nots." (الحالة   ".$shipment->shipmentstatu->name.")  رقم الموبايل   ".$shipment->client->phone."  ".$shipment->client->name."  الي العميل اسم ".$shipment->user->company->name." اسم الشركة ";

                $request =  $shipment->representative_id;
                //02-  اشعار بوصول الشحنه رقم كذا ....... الى العميل اسمه كذا ........... رقم موبايل كذا .............  وحالة الشحنة ( مرتجع جزئي مسدد قيمة الشحن – مرتجع جزئي غير مسدد قيمة الشحن - ................ الخ )


                $this->notification($tokens,$body,$title,$request);
            }
        }elseif ($request->shipment_status_id == 7) {

            $validation = Validator::make($request->all(), [
                'store_id'  =>  'required|exists:stores,id',
                'representative_id'  =>  'required|exists:representatives,id',
            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }
            $store_id = $request->store_id;
            $representative_id = $request->representative_id;

            foreach ($request->shipment_id as $shipment_id) {
                $shipment = Shipment::find($shipment_id);

                if (!$this->calculateStatus7($shipment,$store_id,$representative_id)) {
                    return 0;
                }
                //send notification
                $tokens = [];
                $tokens[] = $shipment->user->token;
                $title = "Shipping";

                $body = " (".$shipment->shipmentstatu->name.")     موبايل ".$shipment->client->phone."   الحالة   " .$shipment->client->name."  رقم الشحنه    ".$shipment->id."  اسم العميل  ";
                $request =  $shipment->user->id;
                //02-  اشعار بوصول الشحنه رقم كذا ....... الى العميل اسمه كذا ........... رقم موبايل كذا .............  وحالة الشحنة ( مرتجع جزئي مسدد قيمة الشحن – مرتجع جزئي غير مسدد قيمة الشحن - ................ الخ )


                $this->notification($tokens,$body,$title,$request);
            }
        }
        elseif ($request->shipment_status_id == 8) {

            $validation = Validator::make($request->all(), [
                'return_price'  =>  'required|regex:/^\d+(\.\d{1,2})?$/',
                'store_id'  =>  'required|exists:stores,id',
                'representative_id'  =>  'required|exists:representatives,id',
            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }
            $return_price = $request->return_price;
            $store_id = $request->store_id;
            $representative_id = $request->representative_id;

            foreach ($request->shipment_id as $shipment_id) {
                $shipment = Shipment::find($shipment_id);

                if (!$this->calculateStatus8($shipment,$return_price,$store_id,$representative_id)) {
                    return 0;
                }

                //send notification
                $tokens = [];
                $tokens[] = $shipment->user->token;
                $title = "Shipping";
                $body = " (".$shipment->shipmentstatu->name.")     موبايل ".$shipment->client->phone."   الحالة   " .$shipment->client->name."  رقم الشحنه    ".$shipment->id."  اسم العميل  ";
                $request =  $shipment->user->id;
//                02-  اشعار بوصول الشحنه رقم كذا ....... الى العميل اسمه كذا ........... رقم موبايل كذا .............  وحالة الشحنة ( مرتجع جزئي مسدد قيمة الشحن – مرتجع جزئي غير مسدد قيمة الشحن - ................ الخ )

                $this->notification($tokens,$body,$title,$request);
            }
        }elseif ($request->shipment_status_id == 9) {
            $validation = Validator::make($request->all(), [
                'return_price'  =>  'required|regex:/^\d+(\.\d{1,2})?$/',
                'store_id'  =>  'required|exists:stores,id',
                'representative_id'  =>  'required|exists:representatives,id',
            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }
            $return_price = $request->return_price;
            $store_id = $request->store_id;
            $representative_id = $request->representative_id;
            foreach ($request->shipment_id as $shipment_id) {
                $shipment = Shipment::find($shipment_id);

                if (!$this->calculateStatus9($shipment,$return_price,$store_id,$representative_id)) {
                    return 0;
                }
                //send notification
                $tokens = [];
                $tokens[] = $shipment->user->token;
                $title = "Shipping";
                $body = " (".$shipment->shipmentstatu->name.")     موبايل ".$shipment->client->phone."   الحالة   " .$shipment->client->name."  رقم الشحنه    ".$shipment->id."  اسم العميل  ";
                $request =  $shipment->user->id;
//                02-  اشعار بوصول الشحنه رقم كذا ....... الى العميل اسمه كذا ........... رقم موبايل كذا .............  وحالة الشحنة ( مرتجع جزئي مسدد قيمة الشحن – مرتجع جزئي غير مسدد قيمة الشحن - ................ الخ )

                $this->notification($tokens,$body,$title,$request);
            }
        }elseif ($request->shipment_status_id == 10){
            $validation = Validator::make($request->all(), [
                'store_id'  =>  'required|exists:stores,id',
                'representative_id'  =>  'required|exists:representatives,id',
            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }
            $store_id = $request->store_id;
            $representative_id = $request->representative_id;

            foreach ($request->shipment_id as $index=>$shipment_id) {
                $shipment = Shipment::find($shipment_id);

                if (!$this->calculateStatus10($shipment,$store_id,$representative_id)) {
                    return 0;
                }
                //send notification
                $tokens = [];
                $tokens[] = $shipment->user->token;
                $title = "Shipping";
                $body = " (".$shipment->shipmentstatu->name.")     موبايل ".$shipment->client->phone."   الحالة   " .$shipment->client->name."  رقم الشحنه    ".$shipment->id."  اسم العميل  ";
                $request =  $shipment->user->id;
//                02-  اشعار بوصول الشحنه رقم كذا ....... الى العميل اسمه كذا ........... رقم موبايل كذا .............  وحالة الشحنة ( مرتجع جزئي مسدد قيمة الشحن – مرتجع جزئي غير مسدد قيمة الشحن - ................ الخ )

                $this->notification($tokens,$body,$title,$request);
            }
        }elseif ($request->shipment_status_id == 11){
            $validation = Validator::make($request->all(), [
                'store_id'  =>  'required|exists:stores,id',
                'representative_id'  =>  'required|exists:representatives,id',
            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }
            $store_id = $request->store_id;
            $representative_id = $request->representative_id;
            foreach ($request->shipment_id as $shipment_id) {
                $shipment = Shipment::find($shipment_id);

                if (!$this->calculateStatus11($shipment,$store_id,$representative_id)) {
                    return 0;
                }
                //send notification
                $tokens = [];
                $tokens[] = $shipment->user->token;
                $title = "Shipping";
                $body = " (".$shipment->shipmentstatu->name.")     موبايل ".$shipment->client->phone."   الحالة   " .$shipment->client->name."  رقم الشحنه    ".$shipment->id."  اسم العميل  ";
                $request =  $shipment->user->id;
//                02-  اشعار بوصول الشحنه رقم كذا ....... الى العميل اسمه كذا ........... رقم موبايل كذا .............  وحالة الشحنة ( مرتجع جزئي مسدد قيمة الشحن – مرتجع جزئي غير مسدد قيمة الشحن - ................ الخ )

                $this->notification($tokens,$body,$title,$request);
            }
        }elseif ($request->shipment_status_id == 12){

            foreach ($request->shipment_id as $shipment_id){
                $shipment = Shipment::find($shipment_id);
                if (!$this->calculateStatus12($shipment)){
                    return 0;
                }
            }
        }



        return response()->json("successfully");
    }
}
