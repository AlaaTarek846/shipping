<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\EmailVerification;
use App\Models\Package;
use App\Models\PackageUser;
use App\Models\User;
use App\Traits\GeneralTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerification as EmailVerificationMail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

class PackageUserController extends Controller
{
    use GeneralTrait;

    public function __constructor()
    {
        $this->middleware("auth")->only(["verifyEmail","resendVerificationCode"]);
        $this->middleware("verified")->only(["userVerified"]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function verifyEmail(Request $request)
    {
        $authUserEmail = JWTAuth::parseToken()->getPayload()->get("email");
        $queryBuilder = EmailVerification::where("email", $authUserEmail)
            ->where("verification_code", $request->verification_code)
            ->where('created_at', '>', Carbon::now()->subMinutes(15));
        $emailVerification = $queryBuilder->first();
        if ($emailVerification) {
            $queryBuilder->delete();
            $user = User::where("email", $authUserEmail)->first();
            $user->email_verified_at = !$user->email_verified_at ? Carbon::now() : $user->email_verified_at;
            $user->save();
        }
        if (!$emailVerification) {
            return response()->json(["errorMessage" => "Verification code is not valid"], 400);
        }
    }

    public function resendVerificationCode()
    {
        $authUserEmail = JWTAuth::parseToken()->getPayload()->get("email");
        $verificationCode = Str::random(5);
        $_emailVerification = EmailVerification::where("email", $authUserEmail)->first();
        $_emailVerification->verification_code = $verificationCode;
        $_emailVerification["created_at"] = Carbon::now();
        $_emailVerification->save();
         Mail::to($authUserEmail)->send(new EmailVerificationMail($verificationCode));
    }
    public function userVerified()
    {
        //To check if user verified
        return response()->json(["verified" => true]);
    }
    public function packageFree(Request $request)
    {
        DB::beginTransaction();

        try {
            $user_auth = user::where('email', $request->email)->orWhere('phone_number', $request->phone_number)->first();

            if ($user_auth) {

                return $this->returnError(' تم النتهاء من مدة العرض', '0', '0');

            } else {

                //      =================validate on Table  Models User and Admin

                $validation = Validator::make($request->all(), [

                    'name' => 'required|string',
                    'email' => 'required|email|unique:users',
                    'photo' => 'mimes:jpeg:jpeg,jpg,png,gif|nullable',
                    'password' => 'required|min:8|confirmed',
                    'phone_number' => 'required|min:11|unique:users',

                ]);
                if ($validation->fails()) {
                    return $this->returnError('errors', $validation->errors());

//                return response()->json($validation->errors(), 422);
                }
                //      =================App\Models\User

                $user = User::create([
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'password' => Hash::make($request['password']),
                    'user_type' => 'admin',
                    'free_date' => now()->addDay(7),
                    'package_date' => now()->addDay(7),

                ]);

                $pakage_user = PackageUser::create([
                    'user_id' => $user->id,
                    'package_date' => now()->addDay(6),
                    'free_date' => now()->format('Y-m-d'),
                    'status' => 'package free 7 day',

                ]);
                $verificationCode = Str::random(5);
                EmailVerification::create([
                    'email' => $request->email,
                    'verification_code' => $verificationCode,
                ]);
                Mail::to($user->email)->send(new EmailVerificationMail($verificationCode));


                //      =================upload  photo  App\Models\Admin

                if ($request->hasFile('photo')) {
                    $file = $request->photo;
                    $new_file = time() . $file->getClientOriginalName();
                    $file->move(public_path() . '/uploads/admin', $new_file);
                } else {
                    $new_file = null;
                }

                //      =================App\Models\Admin

                $admin = Admin::create([
                    "user_id" => $user->id,
                    'name' => $request->name,
                    'free_date' => now()->format('Y-m-d'),
                    'photo' => $new_file,
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
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $user_auth = user::where('email', $request->email)->orWhere('phone_number', $request->phone_number)->first();

            if ($user_auth) {

                return $this->returnError('مشترك من فبل هنا تسجيل مشترك جديد فقط', '0', '0');

            } else {

                //      =================validate on Table  Models User and Admin

                $validation = Validator::make($request->all(), [

                    'name' => 'required|string',
                    'email' => 'required|email|unique:users',
                    'photo' => 'mimes:jpeg:jpeg,jpg,png,gif|nullable',
                    'password' => 'required|min:8|confirmed',
//                        'package_date' => 'required|date',
                    'phone_number' => 'required|min:11|unique:users',

                    //                'date' => 'required|date',
                    //                'package_id' => 'nullable|exists:packages,id',

                ]);
                if ($validation->fails()) {
                    return $this->returnError('errors', $validation->errors());

//                return response()->json($validation->errors(), 422);
                }
                //      =================App\Models\User
                $package = Package::find($id);

                $user = User::create([
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'password' => Hash::make($request['password']),
                    'user_type' => 'admin',
                    'package_date' => now()->addMonths($package->count_months),
                    'package_id' => $id,

                ]);

                $pakage_user = PackageUser::create([
                    'count_months' => $package->count_months,
                    'price' => $package->price,
                    'user_id' => $user->id,
                    'package_id' => $package->id,
                    'start_date' => now()->format('Y-m-d'),
                    'end_date' => now()->addMonths($package->count_months),
                    'status' => 'creat form admin ',

                ]);
                $verificationCode = Str::random(5);
                EmailVerification::create([
                    'email' => $request->email,
                    'verification_code' => $verificationCode,
                ]);
                Mail::to($user->email)->send(new EmailVerificationMail($verificationCode));

                //      =================upload  photo  App\Models\Admin

                if ($request->hasFile('photo')) {
                    $file = $request->photo;
                    $new_file = time() . $file->getClientOriginalName();
                    $file->move(public_path() . '/uploads/admin', $new_file);
                } else {
                    $new_file = null;
                }

                //      =================App\Models\Admin

                $admin = Admin::create([
                    "user_id" => $user->id,
                    'name' => $request->name,
                    'date' => now()->addMonths($package->count_months),
                    'photo' => $new_file,
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        DB::beginTransaction();
        try {

            $validation = Validator::make($request->all(), [

                'phone_number' => 'required|min:11',
                'email' => 'required|email',

            ]);
            if ($validation->fails()) {
                return $this->returnError('errors', $validation->errors());

//                return response()->json($validation->errors(), 422);
            }
            $user_auth = user::whereDate('package_date', '<=', now()->format('Y-m-d'))->where('email', $request->email)
                ->where('phone_number', $request->phone_number)
                ->first();

            if ($user_auth) {
                //      =================validate on Table  Models User and Admin

                $admin = Admin::where('user_id', $user_auth->id)->first();

                //      =================App\Models\User
                $package = Package::find($id);
//return $admin;
                $user_auth->update([
                    'package_date' => now()->addMonths($package->count_months),
                    'package_id' => $package->id,

                ]);

                $admin->update([
                    "user_id" => $user_auth->id,
                    'date' => now()->addMonths($package->count_months),

                ]);

                PackageUser::create([
                    'count_months' => $package->count_months,
                    'price' => $package->price,
                    'user_id' => $user_auth->id,
                    'package_id' => $package->id,
                    'start_date' => now()->addDay(),
                    'end_date' => now()->addMonths($package->count_months),
                    'status' => 'update form admin ',

                ]);


            } else {


                return $this->returnError('', '0', '0');


            }
            DB::commit();

            return $this->returnData('admin', $user_auth, 'successfully');


        } catch (\Exception $e) {
            DB::rollback();

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
        //
    }
}
