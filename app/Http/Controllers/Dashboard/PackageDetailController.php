<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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
    public function store(Request $request)
    {
        try {

            //      =================validate on Table  Models Branch

            $validation = Validator::make($request->all(), [
                'package_detail' => 'required|array',
                'package_detail.*.title' => 'required|string',
                'package_detail.*.title_ar' => 'required|string',
                'package_detail.*.cheack' => 'boolean',
                'package_id' => 'required|exists:packages,id',


            ]);
            if ($validation->fails()) {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }
            foreach($request->package_detail as $package_details){

                 PackageDetail::create([
                    'title' => $package_details['title'],
                    'title_ar' => $package_details['title_ar'],
                    'cheack' => $package_details['cheack'],
                    'package_id' => $request->package_id,
                ]);

            };


            return response()->json('successfully');
//            return $this->returnData('package_details', $package_details, 'successfully');
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
