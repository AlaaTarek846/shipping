<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageDetail;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackageDetailController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $package_detail = PackageDetail::with('package')->get();

        return $this->returnData('package_detail', $package_detail, 'successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request ,$id)
    {
        try {

            //      =================validate on Table  Models Branch

            $validation = Validator::make($request->all(), [
                'title' => 'required|string',
                'title_ar' => 'required|string',
                'cheack' => 'boolean',
            ]);
            if ($validation->fails()) {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }

            $package = Package::find($id);

            $package_details = PackageDetail::create([
                'title' => $request->title,
                'title_ar' => $request->title_ar,
                'cheack' => $request->cheack,
                'package_id' =>$package->id,
            ]);

//            return response()->json('successfully');
            return $this->returnData('package_details', $package_details, 'successfully');
//            return $request->package_detail;

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
        $PackageDetail= PackageDetail::where('package_id',$id)->get();
        return $this->returnData('package_details', $PackageDetail, 'successfully');

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

            //      =================validate on Table  Models Branch

            $validation = Validator::make($request->all(), [
                'title' => 'required|string',
                'title_ar' => 'required|string',
                'cheack' => 'boolean',
            ]);
            if ($validation->fails()) {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }

            $package_details = PackageDetail::find($id);
            $package_details->update([
                'title' => $request->title,
                'title_ar' => $request->title_ar,
                'cheack' => $request->cheack,
                'package_id' =>$request->package_id,
            ]);



//            return response()->json('successfully');
            return $this->returnData('package_details', $package_details, 'successfully');
//            return $request->package_detail;

        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package_details = PackageDetail::findOrFail($id);
        $package_details->delete();
        return response()->json("deleted successfully");
    }
}
