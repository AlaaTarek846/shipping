<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StoreController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $store = Store::with('branch','employee','admin')->where('admin_id',$this->idAdmin())->get();

        return $this->returnData('store', $store, 'successfully');
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

            //      =================validate on Table  Models Branch

            $validation = Validator::make($request->all(), [
                'name' => 'required|unique:stores',
                'address' => 'unique:stores|nullable',
                'phone' => 'required|min:11|unique:stores',
                'branche_id' => 'required|exists:branches,id',
                'employee_id'  =>  'nullable|exists:employees,id',
            ]);
            if ($validation->fails()) {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }
            $store = new Store([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'branche_id' => $request->branche_id,
                'employee_id' => $request->employee_id,
                'admin_id' => $this->idAdmin(),

            ]);


            $store->save();
            return $this->returnData('store', $store, 'successfully');

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
        $store = Store::with('branch','employee','admin')->where('admin_id',$this->idAdmin())->whfindOrFail($id);
        return $this->returnData('store', $store, 'successfully');

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
                'name' => ['required', Rule::unique('stores')->ignore($id)],
                'address' => ['nullable', Rule::unique('stores')->ignore($id)],
                'branche_id' => 'required|exists:branches,id',
                'phone' => 'required|min:11|unique:stores,phone' . ($id ? ",$id" : ''),
                'employee_id'  =>  'nullable|exists:employees,id',
            ]);
            if ($validation->fails()) {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }

            $store = Store::where('admin_id',$this->idAdmin())->findOrFail($id);
            $store->name = $request->name??$store->name;
            $store->address = $request->address??$store->address;
            $store->branche_id = $request->branche_id??$store->branche_id;
            $store->phone = $request->phone??$store->phone;
            $store->employee_id = $request->employee_id??$store->employee_id;
            $store->admin_id = $this->idAdmin()??$this->idAdmin();
            $store->update();

            return $this->returnData('store', $store, 'successfully');

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
        $store = Store::where('admin_id',$this->idAdmin())->find($id);

        if (count($store->shipment) > 0 || $store->employee != null  ){
            return response()->json("no deleted ",422);

        }else{

            $store->destroy($id);

            return response()->json("deleted successfully");
        }
    }
}
