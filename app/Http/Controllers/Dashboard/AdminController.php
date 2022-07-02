<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class AdminController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = Admin::with('user')->get();

        return $this->returnData('admin', $admin, 'successfully');
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
                'photo' => 'mimes:jpeg:jpeg,jpg,png,gif|nullable',
                'password' => 'required|min:8|confirmed',
                'package_date' => 'required|date',
                'date' => 'required|date',
                'package_id' => 'nullable|exists:packages,id',

            ]);
            if ($validation->fails()) {
                return $this->returnError('errors', $validation->errors());

//                return response()->json($validation->errors(), 422);
            }
            //      =================App\Models\User

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request['password']),
                'user_type'=>'admin',
                'package_date'=>$request->package_date,
                'package_id'=>$request->package_id,

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
                'date'=>$request->date,
                'photo'=> $new_file,
            ]);

//            $admin->user;

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
        $admin = Admin::with('user')->findOrFail($id);
        return $this->returnData('admin', $admin, 'successfully');
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

            $admin = Admin::findOrFail($id);
            $user_id = User::find($admin->user_id);

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

            $admin = Admin::find($id);
            $name = $admin->photo;

            if ($request->hasFile('photo')) {
                if ($name !== null) {
                    unlink(public_path('/uploads/admin/') . $name);
                }
                $file = $request->photo;
                $new_file = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/admin', $new_file);
                $admin->photo = $new_file;
            }

            //      =================update    App\Models\user

            $user = $admin->user;
            $user->email = $request->email??$user->email;
            $user->update();

            //      =================update    App\Models\Admin

            $admin->name = $request->name??$admin->name;
            $admin->update();
            DB::commit();

            return $this->returnData('admin', $admin, 'successfully');

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
        $admin = Admin::find($id);

        if ($admin->id == 1){

            return response()->json("no deleted ");

        }else{


            if ($admin->photo !== null) {
                unlink(public_path('uploads/admin/') . $admin->photo);
            }
            $user = User::find($admin->user_id);
            $admin->destroy($id);
            $user->delete();
            return response()->json('deleted successfully');
        }


    }
}
