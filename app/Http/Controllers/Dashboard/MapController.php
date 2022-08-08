<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Map;


class MapController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maps = Map::where('admin_id',$this->idAdmin())->with('representative','shipment')->get();

        return $this->returnData('maps', $maps, 'successfully');
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

            //      =================validate on Table  Models Branch

            $validation = Validator::make($request->all(), [
                'status' => 'string|required',
                'distance' => 'string|nullable',
                'location' => 'string|required',
                'representative_id'  =>  'required|exists:representatives,id',
                'shipment_id'  =>  'required|exists:shipments,id',
            ]);
            if ($validation->fails()) {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }

            $maps = new Map([
                'status' =>$request->status,
                'distance' =>$request->distance,
                'location' =>$request->location,
                'representative_id' =>$request->representative_id,
                'shipment_id' =>$request->shipment_id,
                'admin_id' => $this->idAdmin(),
            ]);


            $maps->save();
            return $this->returnData('maps', $maps, 'successfully');

        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }    }

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
