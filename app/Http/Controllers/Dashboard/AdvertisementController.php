<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdvertisementController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advertisement = Advertisement::all();

        return $this->returnData('advertisement', $advertisement, 'successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            //      =================validate on Table  Models User and Admin

            $validation = Validator::make($request->all(), [

                'photo' => 'mimes:jpeg:jpeg,jpg,png,gif|required',

            ]);
            if ($validation->fails()) {
                return $this->returnError('errors', $validation->errors());

            }

            //      =================upload  photo  App\Models\Admin

            if ($request->hasFile('photo')) {
                $file = $request->photo;
                $new_file = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/advertisement', $new_file);
            }else{
                $new_file = null;
            }

            //      =================App\Models\Admin


            $advertisement = Advertisement::create([

                'photo'=> $new_file,
            ]);


            DB::commit();

            return $this->returnData('advertisement', $advertisement, 'successfully');

        } catch (\Exception $e) {
            DB::rollback();

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
        $advertisement = Advertisement::findOrFail($id);
        return $this->returnData('advertisement', $advertisement, 'successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        DB::beginTransaction();

        try {

            //      =================update validate on Table  Models User and Admin

            $advertisement = Advertisement::findOrFail($id);

            $validation = Validator::make($request->all(), [
                'photo' => 'mimes:jpeg:jpeg,jpg,png,gif',

            ]);
            if ($validation->fails()) {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }

            //      =================update  photo  App\Models\Admin

            $advertisement = Advertisement::find($id);
            $name = $advertisement->photo;

            if ($request->hasFile('photo')) {
                if ($name !== null) {
                    unlink(public_path('/uploads/advertisement/') . $name);
                }
                $file = $request->photo;
                $new_file = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/advertisement', $new_file);
                $advertisement->photo = $new_file;
            }



            $advertisement->update();
            DB::commit();

            return $this->returnData('advertisement', $advertisement, 'successfully');

        } catch (\Exception $e) {
            DB::rollback();

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
        $advertisement = Advertisement::find($id);

            if ($advertisement->photo !== null) {
                unlink(public_path('uploads/advertisement/') . $advertisement->photo);
            }
            $advertisement->destroy($id);
            return response()->json('deleted successfully');
        }


    }
