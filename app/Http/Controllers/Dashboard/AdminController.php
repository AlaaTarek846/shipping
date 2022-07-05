<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageUser;
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
    public function eidtAdminActive($id)
    {
        $user_admin = User::find($id);
        $user_admin->update([
            'is_active' => 1,
        ]);

        return response()->json('successfully');
    }
    public function eidtAdminNoActive($id)
    {
        $user_admin = User::find($id);
        $user_admin->update([
            'is_active' => 0,
        ]);

        return response()->json('successfully');
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
                'package_id' => 'required|exists:packages,id',

            ]);
            if ($validation->fails()) {
                return $this->returnError('errors', $validation->errors());

//                return response()->json($validation->errors(), 422);
            }
//            return $request->package_id;
            //      =================App\Models\User
            $package = Package::where('id',$request->package_id)->first();
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request['password']),
                'user_type'=>'admin',
                'package_date'=>now()->addMonths($package->count_months),
                'package_id'=>$request->package_id,

            ]);

            $pakage_user = PackageUser::create([
                'count_months'=>$package->count_months,
                'start_date'=>now()->addDay(),
                'end_date'=>now()->addMonths($package->count_months),
                'price'=>$package->price,
                'user_id'=> $user->id,
                'package_id'=>$package->id,
                'status' => 'create model admin',
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
                'date'=>now()->addMonths($package->count_months),
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
                'package_id' => 'required|exists:packages,id',

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
            $package = Package::where('id',$request->package_id)->first();



            //      =================update    App\Models\user

            $user = $admin->user;
            $user->email = $request->email??$user->email;
            $user->email = $request->email??$user->email;
            $user->package_date = now()->addMonths($package->count_months)??$user->package_date;
            $user->package_id = $request->package_id??$user->package_id;

            $user->update();
            $pakage_user = PackageUser::create([
                'count_months'=>$package->count_months,
                'start_date'=>now()->addDay(),
                'end_date'=>now()->addMonths($package->count_months),
                'price'=>$package->price,
                'user_id'=> $user->id,
                'package_id'=>$package->id,
                'status' => 'update model admin',
            ]);

            //      =================update    App\Models\Admin

            $admin->name = $request->name??$admin->name;
            $admin->date = now()->addMonths($package->count_months)??$admin->date;

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
