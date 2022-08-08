<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Representative;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::where('admin_id',$this->idAdmin())->with('branch','department','user.roles','job','shipmenttransfer','admin')->latest()->paginate(15);

        return $this->returnData('employees', $employees, 'successfully');
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

            //      =================validate on Table  Models User and Employee

            $validation = Validator::make($request->all(), [

                'name' => 'required|string',
                'address' => 'required|string',
                'salary' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'wallet' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
                'commission' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
                'department_id'  =>  'required|exists:departments,id',
                'branch_id'  =>  'required|exists:branches,id',
                'job_id'  =>  'required|exists:jobs,id',
                'city_id'  =>  'required|exists:cities,id',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8|confirmed',
                'phone_number' => 'required|min:11|unique:users',
                'photo' => 'mimes:jpeg:jpeg,jpg,png,gif|required',
                'cv' => 'mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf|required',
                'face_ID_card_pic' => 'mimes:jpeg:jpeg,jpg,png,gif|required',
                'back_ID_card_pic' => 'mimes:jpeg:jpeg,jpg,png,gif|required',
                'role_id' => 'required|exists:roles,id',

            ]);
            if ($validation->fails()) {
                return $this->returnError('errors', $validation->errors());
            }

            //      =================App\Models\User

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request['password']),
                'phone_number' => $request->phone_number,
                'user_type' => 'employee',

            ]);

            $user->attachRole($request->role_id);

            //      =================upload  photo  App\Models\Employee-photo

            if ($request->hasFile('photo')) {
                $file = $request->photo;
                $new_file = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/employee-photo', $new_file);
            }else{
                $new_file = null;
            }

            //      =================upload  Cv  App\Models\Employee-cv

            if ($request->hasFile('cv')) {
                $file = $request->cv;
                $new2_file = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/employee-cv', $new2_file);
            }else{
                $new2_file = null;
            }

            //      =================upload  face_ID_card_pic  App\Models\Employee-face_ID_card_pic

            if ($request->hasFile('face_ID_card_pic')) {
                $file = $request->face_ID_card_pic;
                $new3_file = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/employee-face_ID_card_pic', $new3_file);
            }else{
                $new3_file = null;
            }
            //      =================upload  back_ID_card_pic  App\Models\Employee-back_ID_card_pic

            if ($request->hasFile('back_ID_card_pic')) {
                $file = $request->back_ID_card_pic;
                $new4_file = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/employee-back_ID_card_pic', $new4_file);
            }else{
                $new4_file = null;
            }

            //      =================App\Models\Employee

            $employee = Employee::create([

                "user_id" => $user->id,
                'name' => $request->name,
                'address' => $request->address,
                'department_id' => $request->department_id,
                'branch_id' => $request->branch_id,
                'job_id' => $request->job_id,
                'city_id' => $request->city_id,
                'salary' => $request->salary,
                'wallet' => $request->wallet,
                'commission' => $request->commission,
                'admin_id' => $this->idAdmin(),
                'photo' => $new_file,
                'cv' => $new2_file,
                'face_ID_card_pic' => $new3_file,
                'back_ID_card_pic' => $new4_file,

            ]);
            $employee->user;

            DB::commit();

            return $this->returnData('employee', $employee, 'successfully');

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
        $employee = Employee::where('admin_id',$this->idAdmin())->with('branch','department','user','job','shipmenttransfer','admin')->findOrFail($id);

            return $this->returnData('employee', $employee, 'successfully');

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
            $employee = Employee::where('admin_id',$this->idAdmin())->findOrFail($id);
            $user_id = User::find($employee->user_id);

            //      =================update validate on Table  Models User and Employee

            $validation = Validator::make($request->all(), [


                'department_id'  =>  'required|exists:departments,id',
                'branch_id'  =>  'required|exists:branches,id',
                'city_id'  =>  'required|exists:cities,id',
                'job_id'  =>  'required|exists:jobs,id',
                'email' => 'required|email|unique:users,email' . ($user_id->id ? ",$user_id->id" : ''),
                'phone_number' => 'required|min:11|unique:users,phone_number'. ($user_id->id ? ",$user_id->id" : ''),
                'name' => 'required|string',
                'address' => 'required|string',
                'salary' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'wallet' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
                'commission' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
                'photo' => 'mimes:jpeg:jpeg,jpg,png,gif',
                'cv' => 'mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf',
                'face_ID_card_pic' => 'mimes:jpeg:jpeg,jpg,png,gif',
                'back_ID_card_pic' => 'mimes:jpeg:jpeg,jpg,png,gif',

            ]);
            if ($validation->fails()) {
                return $this->returnError('errors', $validation->errors());
            }

            $employee = Employee::where('admin_id',$this->idAdmin())->find($id);
            $name = $employee->photo;
            $name2 = $employee->cv;
            $name3 = $employee->face_ID_card_pic;
            $name4 = $employee->back_ID_card_pic;

            //      =================update  photo  App\Models\Employee

            if ($request->hasFile('photo')) {
                if ($name !== null) {
                    unlink(public_path('/uploads/employee-photo/') . $name);
                }
                $file = $request->photo;
                $new_file = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/employee-photo', $new_file);
                $employee->photo = $new_file;
            }

            //      =================update  cv  App\Models\Employee

            if ($request->hasFile('cv')) {
                if ($name2 !== null) {
                    unlink(public_path('/uploads/employee-cv/') . $name2);
                }
                $file = $request->cv;
                $new2_file = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/employee-cv', $new2_file);
                $employee->cv = $new2_file;
            }
            //      =================update  face_ID_card_pic  App\Models\Employee

            if ($request->hasFile('face_ID_card_pic')) {
                if ($name2 !== null) {
                    unlink(public_path('/uploads/employee-face_ID_card_pic/') . $name3);
                }
                $file = $request->face_ID_card_pic;
                $new3_file = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/employee-face_ID_card_pic', $new3_file);
                $employee->face_ID_card_pic = $new3_file;
            }
            //      =================update  back_ID_card_pic  App\Models\Employee

            if ($request->hasFile('back_ID_card_pic')) {
                if ($name2 !== null) {
                    unlink(public_path('/uploads/employee-back_ID_card_pic/') . $name4);
                }
                $file = $request->back_ID_card_pic;
                $new4_file = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/employee-back_ID_card_pic', $new4_file);
                $employee->back_ID_card_pic = $new4_file;
            }

            //      =================update    App\Models\user

            $user = $employee->user;
            $user->phone_number = $request->phone_number??$user->phone_number ;
            $user->email = $request->email??$user->email;
            $user->update();

            //      =================update    App\Models\Employee

            $employee->name = $request->name??$employee->name;
            $employee->wallet = $request->wallet??$employee->wallet ;
            $employee->address = $request->address??$employee->address;
            $employee->commission = $request->commission??$employee->commission;
            $employee->salary = $request->salary??$employee->salary;
            $employee->department_id = $request->department_id??$employee->department_id;
            $employee->branch_id = $request->branch_id??$employee->branch_id;
            $employee->job_id = $request->job_id??$employee->job_id;
            $employee->city_id = $request->city_id??$employee->city_id;
            $employee->admin_id = $this->idAdmin()??$employee->admin_id;


            $employee->update();
            DB::commit();
            return $this->returnData('employee', $employee, 'successfully');

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
        $employee = Employee::where('admin_id',$this->idAdmin())->find($id);

        if (count($employee->shipmenttransfer) > 0){

            return response()->json("no deleted ");

        }else{

            if ($employee->photo !== null) {
                unlink(public_path('uploads/employee-photo/') . $employee->photo);
            }
            if ($employee->cv !== null) {
                unlink(public_path('uploads/employee-cv/') . $employee->cv);
            }
            if ($employee->face_ID_card_pic !== null) {
                unlink(public_path('uploads/employee-face_ID_card_pic/') . $employee->face_ID_card_pic);
            }
            if ($employee->back_ID_card_pic !== null) {
                unlink(public_path('uploads/employee-back_ID_card_pic/') . $employee->back_ID_card_pic);
            }
            $user = User::find($employee->user_id);
            $employee->destroy($id);
            $user->delete();
            return response()->json('deleted successfully');

        }

    }

    /**
     * change role.
     */
    public function changeRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors,422);
        }

        $user = User::where('admin_id',$this->idAdmin())->findOrFail($request->user_id);
        $user->syncRoles([$request->role_id]);

//        return $this->returnData('employee', $employee, 'successfully');

        return response()->json('the role is changed');
    }
}
