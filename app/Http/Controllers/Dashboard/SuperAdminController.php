<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\SuperAdmin;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SuperAdminController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $super_admin = SuperAdmin::with('user')->get();

        return $this->returnData('super_admin', $super_admin, 'successfully');
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

                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8|confirmed',

            ]);
            if ($validation->fails()) {
                return $this->returnError('errors', $validation->errors());

//                return response()->json($validation->errors(), 422);
            }
            //      =================App\Models\User

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request['password']),
                'user_type'=>'speradmin',
            ]);

            //      =================App\Models\Admin

            $super_admin = SuperAdmin::create([
                "user_id" => $user->id,
                'name'=>$request->name,
            ]);

//            $admin->user;

            DB::commit();

            return $this->returnData('super_admin', $user, 'successfully');

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
        $super_admin = SuperAdmin::with('user')->findOrFail($id);
        return $this->returnData('super_admin', $super_admin, 'successfully');
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

            $super_admin = SuperAdmin::findOrFail($id);
            $user_id = User::find($super_admin->user_id);

            $validation = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email' . ($user_id->id ? ",$user_id->id" : ''),
                'photo' => 'mimes:jpeg:jpeg,jpg,png,gif',

            ]);
            if ($validation->fails()) {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }

            //      =================update  photo  App\Models\Admin

            $super_admin = SuperAdmin::find($id);

            //      =================update    App\Models\user

            $user = $super_admin->user;
            $user->email = $request->email??$user->email;
            $user->update();

            //      =================update    App\Models\Admin

            $super_admin->name = $request->name??$super_admin->name;
            $super_admin->update();
            DB::commit();

            return $this->returnData('super_admin', $super_admin, 'successfully');

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
        $super_admin = SuperAdmin::find($id);

        if ($super_admin->id == 1){

            return response()->json("no deleted ");

        }else{

            $super_admin->destroy($id);
            return response()->json('deleted successfully');
        }


    }
}
