<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\RepresentativeArea;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RepresentativeAreaController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $representative_area = RepresentativeArea::where('admin_id',$this->idAdmin())->with('Representative','service_type','area','admin')->get();

        return $this->returnData('representative_area', $representative_area, 'successfully');
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

            //      =================validate on Table  Models ShippingAreaPrice

            $validation = Validator::make($request->all(), [

                'date_representative_area' => 'required|array',
                'date_representative_area.*.receipt_commission' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'date_representative_area.*.return_commission' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'date_representative_area.*.area_id' => 'required|exists:areas,id',
                'date_representative_area.*.representative_id' => 'required|exists:representatives,id',
                'date_representative_area.*.service_type_id' => 'required|exists:service_types,id',
            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }

            foreach ($request->date_representative_area as $date_representative_area) {
                $representative_area = RepresentativeArea::where([['area_id',$date_representative_area['area_id']],['representative_id',$date_representative_area['representative_id']],['admin_id',$this->idAdmin()]])->first();

                if ($representative_area){

                    $representative_area->update([

                        'receipt_commission'=> $date_representative_area['receipt_commission'],
                        'return_commission' =>      $date_representative_area['return_commission'],
                        'area_id' => $date_representative_area['area_id'],
                        'representative_id' =>     $date_representative_area['representative_id'],
                        'service_type_id' =>     $date_representative_area['service_type_id'],
                        'admin_id' => $this->idAdmin(),

                    ]);

                }else{


                    $representative_area = RepresentativeArea::create([

                        'receipt_commission'=> $date_representative_area['receipt_commission'],
                        'return_commission' =>      $date_representative_area['return_commission'],
                        'area_id' => $date_representative_area['area_id'],
                        'representative_id' =>     $date_representative_area['representative_id'],
                        'service_type_id' =>     $date_representative_area['service_type_id'],
                        'admin_id' => $this->idAdmin(),


                    ]);

                }

            }

            DB::commit();

            return response()->json("successfully");


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
        $representative_area = RepresentativeArea::where('admin_id',$this->idAdmin())->findOrFail($id);
        return $this->returnData('representative_area', $representative_area, 'successfully');

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


        try {

            //      =================validate on Table  Models company_shipping_area_price

            $validation = Validator::make($request->all(), [

                '$date_representative_area' => 'required|array',
                '$date_representative_area.*.receipt_commission' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                '$date_representative_area.*.return_commission' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                '$date_representative_area.*.area_id' => 'required|exists:areas,id',
                '$date_representative_area.*.representative_id' => 'required|exists:representatives,id',
                '$date_representative_area.*.service_type_id' => 'required|exists:service_types,id',
            ]);

            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }


            foreach ($request->date_representative_area as $date_representative_area) {

                $representative_area = RepresentativeArea::where(['area_id', $date_representative_area['area_id'],['admin_id',$this->idAdmin()]])->first();

                $representative_area->update([

                    'receipt_commission' => $date_representative_area['receipt_commission'],
                    'return_commission' => $date_representative_area['return_commission'],
                    'area_id' => $date_representative_area['area_id'],
                    'representative_id' => $date_representative_area['representative_id'],
                    'service_type_id' => $date_representative_area['service_type_id'],
                    'admin_id' => $this->idAdmin(),
                ]);
            }
            return response()->json("successfully");


        } catch (\Exception $e) {

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
        $representative_area = RepresentativeArea::where('admin_id',$this->idAdmin())->find($id);


        $representative_area->destroy($id);
        return response()->json("deleted successfully");

    }


}
