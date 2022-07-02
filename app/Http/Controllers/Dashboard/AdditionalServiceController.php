<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AdditionalService;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdditionalServiceController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $additional_service  = AdditionalService::all();

        return $this->returnData('additional_service', $additional_service, 'successfully');
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

            $additional_service = new AdditionalService($request->all());
            $additional_service->save();
            return $this->returnData('additional_service', $additional_service, 'successfully');

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
        $additional_service = AdditionalService::findOrFail($id);
        return $additional_service;
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
            $additional_service = AdditionalService::findOrFail($id);
            $additional_service->update($request->all());

            return $this->returnData('additional_service', $additional_service, 'successfully');

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
        $additional_service = AdditionalService::findOrFail($id);

        if (count($additional_service->shipment) > 0)
        {

            return response()->json("no delete",400);
        }else{

            $additional_service->delete();
        return response()->json("deleted successfully");
        }
    }
}
