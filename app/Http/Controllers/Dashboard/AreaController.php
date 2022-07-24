<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\ShippingAreaPrice;
use App\Models\Governorate;
use App\Models\Citie;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AreaController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $areas = Area::where('admin_id',$this->idAdmin())->with('province.country','admin')->get();

        return $this->returnData('areas', $areas, 'successfully');
    }

    public function governorate()
    {
        $governorate = Governorate::all();
        return $this->returnData('governorate', $governorate, 'successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $validation =Validator::make($request->all(),[
                'name'  => 'required|unique:areas',
                'province_id'  =>  'required|exists:provinces,id'

            ]);
            if ($validation->fails())
            {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }
            $area = new Area([
                'name' => $request->name,
                'province_id' => $request->province_id,
                'admin_id' => $this->idAdmin(),
            ]);
            $area->save();
            $area->province;
            return $this->returnData('area', $area, 'successfully');

        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     *
     *
     */
    public function area_shipment_price($id)
    {
        $areas =  Area::where([['province_id',$id],['admin_id',$this->idAdmin()]])->get();

        $data_area = [];
        $length = 0;
        foreach ($areas as $area){

            if(count($area->shipping_area_price) > 0){

                unset($area['shipping_area_price']);

                $data_area[$length] = $area;

                $length += 1;
            }

        }
        return $this->returnData('area',$data_area, 'successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $area =  Area::with('province.country','admin')->where([['province_id',$id],['admin_id',$this->idAdmin()]])->get();
        return $this->returnData('area',$area, 'successfully');
    }

    public function cityGovernorate($id)
    {
        $city =  Citie::where('governorate_id',$id)->get();
        return $this->returnData('city',$city, 'successfully');
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
        try {

                $validation =Validator::make($request->all(),[

                    'name'  => ['required',Rule::unique('areas')->ignore($id)],
                    'province_id'  =>  'required|exists:provinces,id'

                ]);
                if ($validation->fails())
                {
//                    return response()->json($validation->errors(), 422);
                    return $this->returnError('errors', $validation->errors());

                }
                $area = Area::where('admin_id',$this->idAdmin())->findOrFail($id);
                $area->name = $request->name??$area->name;
                $area->province_id = $request->province_id??$area->province_id;
                $area->admin_id = $this->idAdmin()??$this->idAdmin();
                $area->update();
                $area->province;

                return $this->returnData('area', $area, 'successfully');



        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area = Area::where('admin_id',$this->idAdmin())->findOrFail($id);



        if (count($area->branch) > 0 || count($area->shipment) > 0 || count($area->shipping_area_price) > 0 || count($area->company_shipping_area_prices) > 0 || count($area->representative_area) > 0 )
        {
            return response()->json("no delete",400);
        }else{
            $area->delete();
            return response()->json("deleted successfully");
        }
    }
}
