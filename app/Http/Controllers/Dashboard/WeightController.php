<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Weight;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class WeightController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $weight = Weight::all();

        return $this->returnData('weight', $weight, 'successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $validation = Validator::make($request->all(), [
                'type' => 'nullable|unique:shipment_types',
                'limit' => 'required|integer',
                'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            ]);

            if ($validation->fails()) {
                return $this->returnError('errors', $validation->errors());
            }
            $weight = Weight::first();
            if ($weight) {
                $weight->update([
                    'type' => $request->type,
                    'limit' => $request->limit,
                    'price' => $request->price,
                ]);
            } else {
                $weight = new Weight($request->all());
                $weight->save();
            }

            return $this->returnData('weight', $weight, 'successfully');

        } catch (\Exception $e) {

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
        $weight = Weight::findOrFail($id);
        return $weight;
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
            $validation = Validator::make($request->all(), [
//                'type'  =>  ['nullable', Rule::unique('shipment_types')->ignore($id)],
                'limit' => 'required|nullable|integer',
                'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            ]);
            if ($validation->fails()) {
                return $this->returnError('errors', $validation->errors());
            }
            $weight = Weight::findOrFail($id);
            $weight->update($request->all());

            return $this->returnData('weight', $weight, 'successfully');

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
        $weight = Weight::findOrFail($id);

        $weight->delete();
        return response()->json("deleted successfully");
    }
}
