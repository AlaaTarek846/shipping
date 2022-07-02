<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Package;
use App\Models\PackageUser;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PackageUserController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request ,$id)
    {
        DB::beginTransaction();

        try {
            $user_auth = user::where('email',$request->email)->orWhere('phone_number',$request->phone_number)->first();

                if($user_auth){

                    return $this-> returnError('مشترك من فبل هنا تسجيل مشترك جديد فقط','0','0');

                }else{

                    //      =================validate on Table  Models User and Admin

                    $validation = Validator::make($request->all(), [

                        'name' => 'required|string',
                        'email' => 'required|email|unique:users',
                        'photo' => 'mimes:jpeg:jpeg,jpg,png,gif|nullable',
                        'password' => 'required|min:8|confirmed',
                        'package_date' => 'required|date',
                        'phone_number' => 'required|min:11|unique:users',

    //                'date' => 'required|date',
    //                'package_id' => 'nullable|exists:packages,id',

                    ]);
                    if ($validation->fails()) {
                        return $this->returnError('errors', $validation->errors());

//                return response()->json($validation->errors(), 422);
                    }
                    //      =================App\Models\User
                    $package =Package::find($id);

                    $user = User::create([
                        'email' => $request->email,
                        'phone_number' => $request->phone_number,
                        'password' => Hash::make($request['password']),
                        'user_type'=>'admin',
                        'package_date'=>$request->package_date,
                        'package_id'=>$id,

                    ]);

                    $pakage_user = PackageUser::create([
                        'count_months'=>$package->count_months,
                        'price'=>$package->price,
                        'user_id'=> $user->id,
                        'package_id'=>$package->id,

                    ]);

                    //      =================upload  photo  App\Models\Admin

                    if ($request->hasFile('photo')) {
                        $file = $request->photo;
                        $new_file = time() . $file->getClientOriginalName();
                        $file->move(public_path() . '/uploads/admin', $new_file);
                    }else{
                        $new_file = null;
                    }

                    //      =================App\Models\Admin

                    $admin = Admin::create([
                        "user_id" => $user->id,
                        'name'=>$request->name,
                        'date'=>$package->package_date,
                        'photo'=> $new_file,
                    ]);

//            $admin->user;



                }
                DB::commit();

                return $this->returnData('admin', $user, 'successfully');



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
