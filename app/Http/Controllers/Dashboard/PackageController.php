<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Package;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PackageController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $package = Package::all();

        return $this->returnData('package', $package, 'successfully');
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
                'name' => 'required|unique:packages',
                'name_ar' => 'required|unique:packages',
                'title' => 'required|unique:packages',
                'title_ar' => 'required|unique:packages',
                'duration' => 'required|string',
                'duration_ar' => 'required|string',
                'count_months' => 'required|integer',
                'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'cheack'  =>  'boolean',
            ]);
            if ($validation->fails()) {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }
            $package = new Package($request->all());



            $package->save();
            return $this->returnData('package', $package, 'successfully');

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
        try {
            $validation = Validator::make($request->all(), [

                'name' => ['required', Rule::unique('packages')->ignore($id)],
                'name_ar' => ['required', Rule::unique('packages')->ignore($id)],
                'title' => ['required', Rule::unique('packages')->ignore($id)],
                'title_ar' => ['required', Rule::unique('packages')->ignore($id)],
                'duration' => 'required|string',
                'duration_ar' => 'required|string',
                'count_months' => 'required|integer',
                'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'cheack'  =>  'boolean',
            ]);
            if ($validation->fails()) {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }

            $package = Package::findOrFail($id);

            $package->update($request->all());

            $package->update();
            return $this->returnData('package', $package, 'successfully');

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
        $package = Package::find($id);

//        if (count($branch->store) > 0 || count($branch->employees) > 0 || count($branch->company) > 0 ){
//
//            return response()->json("no deleted ");
//
//        }else{


            $package->destroy($id);
            return response()->json("deleted successfully");

//        }
    }
}
