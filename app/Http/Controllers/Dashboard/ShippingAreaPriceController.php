<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\ShippingAreaPrice;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ShippingAreaPriceController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipping_area_price = ShippingAreaPrice::where('admin_id',$this->idAdmin())->with('area.province','admin')->get();

        return $this->returnData('shippingareaprice', $shipping_area_price, 'successfully');
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

            $validation = Validator::make($request->all(), [
                'transportation_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'delivery_time' => 'nullable|integer',
                'returned_time' => 'nullable|integer',
                'area_id' => 'required|exists:areas,id'
            ]);

            if ($validation->fails()) {
                return $this->returnError('errors', $validation->errors());
            }
            $shipping_area_price = ShippingAreaPrice::where([["area_id",$request->area_id],['admin_id',$this->idAdmin()]])->first();
            if ($shipping_area_price){
                return $this->returnError('errors', "this area already exist");
            }
            $shipping_area_price = ShippingAreaPrice::create([
                'transportation_price' => $request->transportation_price,
                'delivery_time' => $request->delivery_time,
                'returned_time' => $request->returned_time,
                'area_id' => $request->area_id,
                'admin_id' => $this->idAdmin(),

            ]);

            DB::commit();

            return $this->returnData('shipping_area_price', $shipping_area_price, 'successfully');


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
        $shipping_area_price = ShippingAreaPrice::where('admin_id',$this->idAdmin())->findOrFail($id);
        return $this->returnData('shipping_area_price', $shipping_area_price, 'successfully');

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

                'transportation_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'delivery_time' => 'nullable|integer',
                'returned_time' => 'nullable|integer',
                'area_id' => 'required|exists:areas,id'
            ]);

            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }
            if ($request->seve_for_all == 1) {
                $province_area = Area::where('admin_id',$this->idAdmin())->with('province')->find($request->area_id);
                $areas = $province_area->province->areas;
                foreach ($areas as $area) {
                    if (count($area->shipping_area_price) > 0){

                        $area->shipping_area_price[0]->update([
                            'transportation_price' => $request->transportation_price,
                            'delivery_time' => $request->delivery_time,
                            'returned_time' => $request->returned_time,
                            'admin_id' => $this->idAdmin(),

                        ]);
                    }

                }

            } else{

                $shipping_area_price = ShippingAreaPrice::where('admin_id',$this->idAdmin())->find($id);

                $shipping_area_price->update([

                    'transportation_price' => $request->transportation_price,
                    'delivery_time' => $request->delivery_time,
                    'returned_time' => $request->returned_time,
                    'area_id' => $request->area_id,
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
        $shipping_area_price = ShippingAreaPrice::where('admin_id',$this->idAdmin())->find($id);


        $shipping_area_price->destroy($id);
        return response()->json("deleted successfully");

    }


}
