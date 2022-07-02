<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\RepresentativeAccountDetail;
use App\Models\Shipment;
use App\Models\ShipmentStatu;
use App\Traits\GeneralTrait;
use App\Traits\ShipmentTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AllRepresentativeController extends Controller
{
    use GeneralTrait;
    use ShipmentTrait;

    public function shipmentStatuRepresentative()
    {
        $Shipment_Statu_Representative =  ShipmentStatu::find([3,4,7,8,9,10,11]);
        return $this->returnData('Shipment_Statu_Representative', $Shipment_Statu_Representative, 'successfully');

    }

    public function shipmentRepresentative()
    {

        $representative_id  = auth()->user()->representative->id;

        $RepresentativeAccountDetail = RepresentativeAccountDetail::where([
            ['representative_account_id', "!=", NULL],
            ['representative_id', $representative_id],
        ])->get()->pluck('shipment_id')->toArray();

        $Shipment_Representative =  Shipment::with('area', 'client', 'representative.user', 'serviceType','shipmentstatu','additionalservice', 'store', 'user')
            ->where('representative_id', $representative_id)->whereNotIn('id', $RepresentativeAccountDetail)
            ->get();
        return $this->returnData('Shipment_Representative', $Shipment_Representative, 'successfully');

    }
    public function totalGetShipmentRepresentative()
    {
        $representative_id = auth()->user()->representative->id;

        $date =[];

        // count Shipment Representative
        $count_Shipment = Shipment::where([
            ['shipment_status_id',2],
            ['representative_id',$representative_id],
        ])->orWhere([
            ['shipment_status_id' , 3],
            ['representative_id',$representative_id],
        ])->orWhere([
            ['shipment_status_id' , 4],
            ['representative_id',$representative_id],
        ])->orWhere([
            ['shipment_status_id' , 5],
            ['representative_id',$representative_id],
        ])->orWhere([
            ['shipment_status_id' , 6],
            ['representative_id',$representative_id],
        ])->count();

        $total_collection_balance =  RepresentativeAccountDetail::where([
            ['representative_id',$representative_id],
            ['representative_account_id',null]
        ])->sum('collection_balance');

        $total_commission =  RepresentativeAccountDetail::where([
            ['representative_id',$representative_id],
            ['representative_account_id',null]
        ])->sum('commission');



        $date['count_Shipment'] = $count_Shipment ;
        $date['total_collection_balance'] = $total_collection_balance ;
        $date['total_commission'] = $total_commission ;

        return $this->returnData('data', $date, 'successfully');

    }

    public  function shipmentRepresentativesearch(Request $request){

        $validation = Validator::make($request->all(), [

            'number_id' => 'required|exists:shipments,id',

        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 422);
        }
        $representative_id  = auth()->user()->representative->id;
        $get_all_Shipment = Shipment::
        where([
            ['id','=',$request->number_id],
            ['representative_id',$representative_id],
        ])->with('area', 'client', 'representative.user', 'serviceType','shipmentstatu','additionalservice', 'store', 'user')->first();

        return $this->returnData('search_date', $get_all_Shipment, 'successfully');


    }

    public function shipmentStatuFilter(Request $request){

        $validation = Validator::make($request->all(), [
            'status' => 'required|',
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 422);
        }
        $representative_id = auth()->user()->representative->id;

        if ($request->status == 3){
            $shipment_status = Shipment::with('area', 'client', 'representative.user', 'serviceType','shipmentstatu','additionalservice', 'store', 'user')->where([
                ['shipment_status_id',3],
                ['representative_id',$representative_id],
            ])->get();
        }elseif ($request->status == 6){

            $shipment_status = Shipment::with('area', 'client', 'representative.user', 'serviceType','shipmentstatu','additionalservice', 'store', 'user')->where([
                ['shipment_status_id',6],
                ['representative_id',$representative_id],
            ])->get();

        }elseif ($request->status == 7){

            $shipment_status = Shipment::with('area', 'client', 'representative.user', 'serviceType','shipmentstatu','additionalservice', 'store', 'user')->where([
                ['shipment_status_id',7],
                ['representative_id',$representative_id],
            ])->get();

        }elseif ($request->status == 8){

            $shipment_status = Shipment::with('area', 'client', 'representative.user', 'serviceType','shipmentstatu','additionalservice', 'store', 'user')->where([
                ['shipment_status_id',8],
                ['representative_id',$representative_id],
            ])->orWhere([
                ['shipment_status_id' , 9],
                ['representative_id',$representative_id],
            ])->orWhere([
                ['shipment_status_id' , 10],
                ['representative_id',$representative_id],
            ])->orWhere([
                ['shipment_status_id' , 11],
                ['representative_id',$representative_id],
            ])->get();

        }else{
            return Response()->json(['Error'=>['not found status']]);
        }

        return $this->returnData('Shipment_status', $shipment_status, 'successfully');


    }

    public function shipmentStatu6()
    {

        $representative_id  = auth()->user()->representative->id;
        $Shipment_Representative =  Shipment::
        where([
            ['representative_id',$representative_id],
            ['shipment_status_id',6],

        ])->with('area', 'client', 'representative.user', 'serviceType','shipmentstatu','additionalservice', 'store', 'user')->get();
        return $this->returnData('Shipment_Statu_6', $Shipment_Representative, 'successfully');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
