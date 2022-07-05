<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Client;
use App\Models\CompanyShippingAreaPrice;
use App\Models\ShippingAreaPrice;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CompanyShippingsAreasPrices extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $company_shipping_area_Price = CompanyShippingAreaPrice::where([['company_id', $id],['admin_id',$this->idAdmin()]])->with('area.province','company')->get();

        return $this->returnData('company_shipping_area_Price', $company_shipping_area_Price, 'successfully');
    }

    public function company_area_Price()
    {
        $company_id = auth()->user()->company->id;

        $company_shipping_area_Price = CompanyShippingAreaPrice::where([['company_id', $company_id],['admin_id',$this->idAdmin()]])->get();

        return $this->returnData('company_shipping_area_Price', $company_shipping_area_Price, 'successfully');
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

            //      =================validate on Table  Models company_shipping_area_price


                $validation = Validator::make($request->all(), [
                    'areas_id.*'  =>  'required|exists:shipping_area_prices,id',
                    'company_id' => 'required|exists:companies,id',
                ]);


            if ($validation->fails()) {
                return $this->returnError('errors', $validation->errors());
            }
            foreach ($request->areas_id as $area_price){

                $ShippingAreaPrice = ShippingAreaPrice::where('admin_id',$this->idAdmin())->find($area_price);
                $company_shipping_area_price = CompanyShippingAreaPrice::where([['area_id', $ShippingAreaPrice->area_id],['company_id', $request->company_id],['admin_id',$this->idAdmin()]])->first();

                if ($company_shipping_area_price){

                    $company_shipping_area_price->update([

                        'transportation_price' => $ShippingAreaPrice->transportation_price,
                        'delivery_time' => $ShippingAreaPrice->delivery_time,
                        'returned_time' => $ShippingAreaPrice->returned_time,
                        'company_id' => $request->company_id,
                        'area_id' => $ShippingAreaPrice->area_id,
                        'admin_id' => $this->idAdmin(),

                    ]);

                }else{

                      CompanyShippingAreaPrice::create([

                        'transportation_price' => $ShippingAreaPrice->transportation_price,
                        'delivery_time' => $ShippingAreaPrice->delivery_time,
                        'returned_time' => $ShippingAreaPrice->returned_time,
                        'company_id' => $request->company_id,
                        'area_id' => $ShippingAreaPrice->area_id,
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
        $company_shipping_area_Price = ShippingAreaPrice::where('admin_id',$this->idAdmin())->
        findOrFail($id);
        return $this->returnData('company_shipping_area_Price', $company_shipping_area_Price, 'successfully');

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
                'area_id' => 'required|exists:areas,id',
                'company_id' => 'required|exists:companies,id',
            ]);

            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }


            if ($request->seve_for_all == 1) {

                $province_area = Area::with('province')->where('admin_id',$this->idAdmin())->find($request->area_id);
                $areas = $province_area->province->areas;
                foreach ($areas as $area) {
                    $company_shipping_area_Price = CompanyShippingAreaPrice::where([
                        ["company_id", $request->company_id],
                        ["area_id", $area->id],
                        ['admin_id',$this->idAdmin()]
                    ])->first();
                    if ($company_shipping_area_Price) {
                        $company_shipping_area_Price->update([
                            'transportation_price' => $request->transportation_price,
                            'delivery_time' => $request->delivery_time,
                            'returned_time' => $request->returned_time,
                            'admin_id' => $this->idAdmin(),

                        ]);
                    }

                }

            } else {

                $company_shipping_area_Price = CompanyShippingAreaPrice::where('admin_id',$this->idAdmin())->find($id);

                $company_shipping_area_Price->update([

                    'transportation_price' => $request->transportation_price,
                    'delivery_time' => $request->delivery_time,
                    'returned_time' => $request->returned_time,
                    'area_id' => $request->area_id,
                    'company_id' => $request->company_id,
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
        $company_shipping_area_Price = CompanyShippingAreaPrice::where('admin_id',$this->idAdmin())->find($id);

        $company_shipping_area_Price->destroy($id);
        return response()->json("deleted successfully");

    }


}
