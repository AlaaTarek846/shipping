<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use App\Traits\ShipmentTrait;
use Illuminate\Http\Request;
use App\Models\Shipment;
use App\Models\DetailShipmentRepresentative;

class DetailShipmentRepresentativeShipmentController extends Controller
{
    use GeneralTrait;
    use ShipmentTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

       $detali =  DetailShipmentRepresentative::with('representative.user','shipment','shipmentstatu','store')->
       where([
           ['shipment_id',$id],
           ['representative_id','!=',null],
           ['store_id','!=',null]
           ])->get();

        return $this->returnData('detali', $detali, 'successfully');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $update_shipment = Shipment::
        where([
            ['representative_id','!=',null],
            ['store_id','!=',null],
            ['shipment_status_id','!=',1]
        ])->get();
        foreach ($update_shipment as $shipment){

            DetailShipmentRepresentative::create([
                'representative_id' => $shipment->representative_id,
                'shipment_id' => $shipment->id,
                'shipment_status_id' => $shipment->shipment_status_id,
                'store_id' => $shipment->store_id,
            ]);

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
