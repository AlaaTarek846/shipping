<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\TransportType;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TransportTypeController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transport_type  = TransportType::all();

        return $this->returnData('transport_type', $transport_type, 'successfully');
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
                'type'  =>  'required|unique:transport_types',
                'price'  =>  'required|regex:/^\d+(\.\d{1,2})?$/',
            ]);
            if ($validation->fails())
            {
                return $this->returnError('errors', $validation->errors());
            }
            $transport_type = new TransportType($request->all());
            $transport_type->save();
            return $this->returnData('transport_type', $transport_type, 'successfully');

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
        $transport_type = TransportType::findOrFail($id);
        return $transport_type;
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
                'type'  =>  ['required', Rule::unique('transport_types')->ignore($id)],
                'price'  =>  'required|regex:/^\d+(\.\d{1,2})?$/',

            ]);
            if ($validation->fails())
            {
                return $this->returnError('errors', $validation->errors());
            }
            $transport_type = TransportType::findOrFail($id);
            $transport_type->update($request->all());

            return $this->returnData('transport_type', $transport_type, 'successfully');

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
        $transport_type = TransportType::findOrFail($id);

        if (count($transport_type->pickup) > 0)
        {

            return response()->json("no delete",400);
        }else{

            $transport_type->delete();
            return response()->json("deleted successfully");
        }
    }
}
