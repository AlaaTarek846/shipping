<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ServiceType;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ServiceTypeController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service_type  = ServiceType::all();

        return $this->returnData('service_type', $service_type, 'successfully');
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
                'type'  =>  'required|unique:service_types',
            ]);

            if ($validation->fails())
            {
                return $this->returnError('errors', $validation->errors());
            }

            $service_type = new ServiceType($request->all());
            $service_type->save();
            return $this->returnData('service_type', $service_type, 'successfully');

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
        $shipment_type = ServiceType::findOrFail($id);
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
                'type'  =>  ['required', Rule::unique('service_types')->ignore($id)],

            ]);
            if ($validation->fails())
            {
                return $this->returnError('errors', $validation->errors());
            }
            $service_type = ServiceType::findOrFail($id);
            $service_type->update($request->all());

            return $this->returnData('service_type', $service_type, 'successfully');

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
        $service_type = ServiceType::findOrFail($id);

        if (count($service_type->shipment) > 0 || count($service_type->representative_area) > 0 )
        {
            return response()->json("no delete",400);
        }else{
            $service_type->delete();
            return response()->json("deleted successfully");
        }
    }
}
