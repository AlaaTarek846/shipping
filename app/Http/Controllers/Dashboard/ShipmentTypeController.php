<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ShipmentType;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ShipmentTypeController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipment_type  = ShipmentType::all();

        return $this->returnData('shipment_type', $shipment_type, 'successfully');
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
                'type'  =>  'required|unique:shipment_types',
                'price'  =>  'required|regex:/^\d+(\.\d{1,2})?$/',
            ]);

            if ($validation->fails())
            {
                return $this->returnError('errors', $validation->errors());
            }

            $shipment_type = new ShipmentType($request->all());
            $shipment_type->save();
            return $this->returnData('shipment_type', $shipment_type, 'successfully');

        } catch (\Exception $e) {

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
        $shipment_type = ShipmentType::findOrFail($id);
        return $shipment_type;
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
                'type'  =>  ['required', Rule::unique('shipment_types')->ignore($id)],
                'price'  =>  'required|regex:/^\d+(\.\d{1,2})?$/',
            ]);
            if ($validation->fails())
            {
                return $this->returnError('errors', $validation->errors());
            }
            $shipment_type = ShipmentType::findOrFail($id);
            $shipment_type->update($request->all());

            return $this->returnData('shipment_type', $shipment_type, 'successfully');

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
        $shipment_type = ShipmentType::findOrFail($id);

//        if (count($country->provinces) > 0)
//        {
//
//            return response()->json("no delete",400);
//        }else{

        $shipment_type->delete();
        return response()->json("deleted successfully");
//        }
    }
}
