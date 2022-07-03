<?php

namespace App\Http\Controllers\AuthUser;

use App\Http\Controllers\Controller;
use App\Models\Representative;
use App\Models\UserApiK;
use App\Traits\GeneralTrait;
use http\Env\Response;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Client;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Validator;

class AuthUserMobileController extends Controller
{
    use GeneralTrait;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'userProfile', 'registercompany' ,'forgotpassword','checkphone','loginRepresentative']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8',
            'phone_number' => 'required|min:11',
//            'token' => 'required',


        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user_phone = User::where('phone_number', $request->phone_number)->first();

        if ($user_phone) {

            if($user_phone->user_type == "admin" && $user_phone->package_date <= now()->format('Y-m-d') && $user_phone->is_active == 0) {
                return response()->json("not active admin");
            }elseif($user_phone->user_type == "client" && $user_phone->client->admin->user->package_date <= now()->format('Y-m-d') && $user_phone->client->admin->user->is_active == 0){
                return response()->json("not active client");

            }elseif($user_phone->user_type == "representative" && $user_phone->representative->admin->user->package_date <= now()->format('Y-m-d') && $user_phone->representative->admin->user->is_active == 0){
                return response()->json("not active representative");

            }elseif($user_phone->user_type == "employee" && $user_phone->employee->admin->user->package_date <= now()->format('Y-m-d') && $user_phone->employee->admin->user->is_active == 0){
                return response()->json("not active employee");

            }elseif($user_phone->user_type == "company" && $user_phone->company->admin->user->package_date <= now()->format('Y-m-d') && $user_phone->company->admin->user->is_active == 0){
                return response()->json("not active company");

            }

            if (Hash::check($request->password, $user_phone->password)) {

                if (!$token = auth()->attempt($validator->validated())) {

                    return response()->json(['error' => 'Unauthorized'], 200);
                }
                $user_phone->update([
                    'token' => $request->header('token'),
                ]);

                return $this->createNewToken($token);

            } else {

                return $this-> returnError('Not Found Password','1','1');

            }

        } else {

                return $this-> returnError('Not Found PhoneNumber','0','0');

        }

    }

    public function loginRepresentative(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8',
            'phone_number' => 'required|min:11',
            'token' => 'nullable|string',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user_phone = User::where('phone_number', $request->phone_number)->first();

        if ($user_phone) {

            if($user_phone->user_type == "admin" && $user_phone->package_date <= now()->format('Y-m-d') && $user_phone->is_active == 0) {
                return response()->json("not active admin");
            }elseif($user_phone->user_type == "client" && $user_phone->client->admin->user->package_date <= now()->format('Y-m-d') && $user_phone->client->admin->user->is_active == 0){
                return response()->json("not active client");

            }elseif($user_phone->user_type == "representative" && $user_phone->representative->admin->user->package_date <= now()->format('Y-m-d') && $user_phone->representative->admin->user->is_active == 0){
                return response()->json("not active representative");

            }elseif($user_phone->user_type == "employee" && $user_phone->employee->admin->user->package_date <= now()->format('Y-m-d') && $user_phone->employee->admin->user->is_active == 0){
                return response()->json("not active employee");

            }elseif($user_phone->user_type == "company" && $user_phone->company->admin->user->package_date <= now()->format('Y-m-d') && $user_phone->company->admin->user->is_active == 0){
                return response()->json("not active company");

            }

            if ($user_phone->user_type != 'representative'){
                return $this-> returnError('Not Found user','2','2');

            }

            if (Hash::check($request->password, $user_phone->password)) {
                if (!$token = auth()->attempt($validator->validated())) {

                    return response()->json(['error' => 'Unauthorized'], 200);
                }
                auth()->user()->update([
                    'token' => $request->header('token'),
                ]);

                return $this->createNewToken($token);

            } else {

                return $this-> returnError('Not Found Password','1','1');

            }

        } else {

            return $this-> returnError('Not Found PhoneNumber','0','0');

        }

    }


    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {

        DB::beginTransaction();

        try {

            $client = Client::where('phone', $request->phone_number)->first();
            if ($client) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|between:2,100',
                    'email' => 'required|string|email|max:100|unique:users',
                    'password' => 'required|string|confirmed|min:8',
                    'phone_number' => 'required|min:11|unique:users,phone_number',
                    'city_id'  =>  'nullable|exists:cities,id',
                    'token' => 'nullable|string',

                ]);
                if ($validator->fails()) {
//                    return response()->json($validator->errors()->toJson(), 400);
                    return $this->returnError('errors', $validator->errors());

                }

                $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)],
                    ['token' => '$request->token'],


                ));

                $client->update([
                    "user_id" => $user->id,
                    'name' => $request->name,
                    'phone' => $request->phone_number,
                    'email_2' => $user->email,
                    'city_id' => $request->city_id,
                ]);


            } else {

                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|between:2,100',
                    'email' => 'required|string|email|max:100|unique:users',
                    'password' => 'required|string|confirmed|min:8',
                    'phone_number' => 'required|min:11|unique:users,phone_number',
                    'city_id'  =>  'required|exists:cities,id',
                    'token' => 'nullable|string',


                ]);
                if ($validator->fails()) {
//                    return response()->json($validator->errors()->toJson(), 400);
                    return $this->returnError('errors', $validator->errors());

                }

                $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)],
                    ['token' => '$request->token'],


                ));

                //      =================App\Models\Client

                $client = Client::create([
                    "user_id" => $user->id,
                    'name' => $request->name,
                    'email_2' => $user->email,
                    'phone' => $request->phone_number,
                    'city_id' => $request->city_id,

                ]);

            }
            DB::commit();

            if (!$token = auth()->attempt(['phone_number' => $request->phone_number, 'password' => $request->password])) {

                return response()->json(['error' => 'Unauthorized'], 401);
            }

            return $this->createNewToken($token);

//            return response()->json([
//                'message' => 'User successfully registered',
//                'client' => $client
//            ], 201);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function registercompany(Request $request)
    {

        DB::beginTransaction();

        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|between:2,100',
                'email' => 'required|string|email|max:100|unique:users',
                'password' => 'required|string|confirmed|min:8',
                'phone_number' => 'required|min:11|unique:users,phone_number',
                'city_id'  =>  'required|exists:cities,id',
                'photo' => 'nullable|mimes:jpeg:jpeg,jpg,png,gif|nullable',
                'token' => 'nullable|string',
            ]);
            if ($validator->fails()) {
//                return response()->json($validator->errors()->toJson(), 400);
                return $this->returnError('errors', $validator->errors());

            }

            $user = User::create(array_merge(
                $validator->validated(),
                ['password' => bcrypt($request->password)],
                ['user_type' => 'company'],
                ['token' => '$request->token'],

            ));

            $user_api_K = UserApiK::create([
                "user_id" => $user->id,
                'api_k' =>Str::random(50),
            ]);

            //      =================upload  photo  App\Models\company

            if ($request->hasFile('photo')) {
                $file = $request->photo;
                $new_file = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/company', $new_file);
            }else{
                $new_file = null;
            }

            //      =================App\Models\Company

            $company = Company::create([
                "user_id" => $user->id,
                'name' => $request->name,
                'phone' => $request->phone,
                'city_id' => $request->city_id,
                'photo' => $new_file,

            ]);

            $company->user->userApiK;
            DB::commit();

            if (!$token = auth()->attempt(['phone_number' => $request->phone_number, 'password' => $request->password])) {

                return response()->json(['error' => 'Unauthorized'], 401);
            }

            return $this->createNewToken($token);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }


    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            //      =================update validate on Table  Models User and Client
            $client = Client::findOrFail($id);
            $user_id = User::find($client->user_id);

            $validation = \Illuminate\Support\Facades\Validator::make($request->all(), [

                'photo' => 'nullable|mimes:jpeg:jpeg,jpg,png,gif',
                'name' => 'required|string',
                'address' => 'required|string',
                'google_location' => 'nullable|string',
                'email_2' => 'nullable|email|unique:clients,email_2'. ($id ? ",$id" : ''),
                'email' => 'required|email|unique:users,email' . ($user_id->id ? ",$user_id->id" : ''),
                'phone' => 'required|min:11|unique:clients,phone' . ($id ? ",$id" : ''),
                'phone_2' => 'nullable|min:11',
                'token' => 'nullable|string',
                'firebase_id' => 'nullable|string',
                'city_id'  =>  'required|exists:cities,id',


            ]);
            if ($validation->fails()) {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }

            //      =================update  photo  App\Models\Client

            $client = Client::find($id);
            $name = $client->photo;

            if ($request->hasFile('photo')) {
                if ($name !== null) {
                    unlink(public_path('/uploads/client/') . $name);
                }
                $file = $request->photo;
                $new_file = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/client', $new_file);
                $client->photo = $new_file;
            }


            //      =================update    App\Models\user

            $user = $client->user;

            $user->phone_number = $request->phone;
            $user->email = $request->email;
            $user->update();

            //      =================update    App\Models\user
            //
            $client->name = $request->name;
            $client->address = $request->address;
            $client->google_location = $request->google_location;
            $client->phone = $request->phone;
            $client->phone_2 = $request->phone_2;
            $client->email_2 = $user->email;
            $client->city_id = $request->city_id;

            $client->update();

            //        return response()->json($client);
//            return $this->returnData('client', $client, 'تم العمليه بنجاح');
            DB::commit();
            return response()->json(auth()->user());

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }


    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => collect(auth()->user())->filter()
        ]);
    }

    public function changePassword(Request $request)
    {
        $user = auth()->user();

        if ($user == null) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors, 400);
        }

        if (Hash::check($request->old_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->input('password')),
            ]);

            return response()->json("change password successfully");

        } else {

            return response()->json("sorry the old password is not correct", 200);

        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        $user = auth()->user();

        return response()->json($user);

    }


    public function update_company_Profile(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            //      =================update validate on Table  Models User and Company
            $company = Company::findOrFail($id);
            $user_id = User::find($company->user_id);


            $validation = \Illuminate\Support\Facades\Validator::make($request->all(), [



                'name' => 'required|string',
                'address' => 'required|string',
                'phone' => 'nullable|min:11|unique:companies,phone' . ($id ? ",$id" : ''),
                'photo' => 'nullable|mimes:jpeg:jpeg,jpg,png,gif',
                'google_location' => 'nullable|string',
                'token' => 'nullable|string',
                'email' => 'required|email|unique:users,email' . ($user_id->id ? ",$user_id->id" : ''),
                'phone_number' => 'nullable|min:11|unique:users,phone_number' . ($user_id->id ? ",$user_id->id" : ''),
                'city_id'  =>  'required|exists:cities,id',

            ]);
            if ($validation->fails()) {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }

            //      =================update  photo  App\Models\Client

            $company = Company::findOrFail($id);
            $name = $company->photo;

            if ($request->hasFile('photo')) {
                if ($name !== null) {
                    unlink(public_path('/uploads/company/') . $name);
                }
                $file = $request->photo;
                $new_file = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/company', $new_file);
                $company->photo = $new_file;
            }


            //      =================update    App\Models\user

            $user = $company->user;

            $user->phone_number = $request->phone;
            $user->email = $request->email;
            $user->update();

            //      =================update    App\Models\user

            $company->name = $request->name??$company->name;
            $company->address = $request->address??$company->address;
            $company->google_location = $request->google_location??$company->google_location;
            $company->phone = $request->phone??$company->phone;
            $company->city_id = $request->city_id??$company->city_id;

            $company->update();
            DB::commit();
            //        return response()->json($client);
            return $this->returnData('company', $company, 'successfully');

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }

    }



    public function forgotpassword(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'phone_number' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::where('phone_number',$request->phone_number)->first();

        if ($user){

            $user->update([
                'password' => Hash::make($request->input('password')),
            ]);

            return response()->json("successfully");

        } else {

            return response()->json("sorry the phone_number is not correct", 200);

        }

    }

    public function checkphone(Request $request){

        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|min:11',
        ]);

        if ($validator->fails()) {
//            return response()->json($validator->errors(), 422);
            return $this->returnError('errors', $validator->errors());

        }
        $user_phone = User::where('phone_number', $request->phone_number)->first();

        if ($user_phone) {

            return response()->json('successfully');

        } else {

            return $this-> returnError('Not Found PhoneNumber','');

        }


    }

    public function update_representative(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $representative = Representative::findOrFail($id);
            $user_id = User::find($representative->user_id);

            //      =================update validate on Table  Models User and Representative

            $validation = \Illuminate\Support\Facades\Validator::make($request->all(), [

                'name' => 'required|string',
                'city' => 'required|string',
                'address' => 'required|string',
                'national_id' => 'nullable|min:11|unique:representatives,national_id' . ($id ? ",$id" : ''),
                'wallet' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'email' => 'required|email|unique:users,email' . ($user_id->id ? ",$user_id->id" : ''),
                'phone_number' => 'required|min:11|unique:users,phone_number'. ($user_id->id ? ",$user_id->id" : ''),
                'photo' => 'mimes:jpeg:jpeg,jpg,png,gif|nullable',
                'cv' => 'mimes:jpeg:jpeg,jpg,png,gif|nullable',
                'license_photo' => 'mimes:jpeg:jpeg,jpg,png,gif|nullable',
                'fish_photo' => 'mimes:jpeg:jpeg,jpg,png,gif|nullable',
                'area_id'  =>  'required|exists:areas,id',


            ]);
            if ($validation->fails()) {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }

            $representative = Representative::find($id);
            $name = $representative->photo;
            $name2 = $representative->cv;
            $name3 = $representative->license_photo;
            $name4 = $representative->fish_photo;

            //      =================update  photo - cv  App\Models\Representative

            if ($request->hasFile('photo')) {
                if ($name !== null) {
                    unlink(public_path('/uploads/representative-photo/') . $name);
                }
                $file = $request->photo;
                $new_file = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/representative-photo', $new_file);
                $representative->photo = $new_file;
            }
            if ($request->hasFile('cv')) {
                if ($name2 !== null) {
                    unlink(public_path('/uploads/representative-cv/') . $name2);
                }
                $file = $request->cv;
                $new2_file = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/representative-cv', $new2_file);
                $representative->cv = $new2_file;
            }

            if ($request->hasFile('license_photo')) {
                if ($name3 !== null) {
                    unlink(public_path('/uploads/representative-license_photo/') . $name3);
                }
                $file = $request->license_photo;
                $new3_file = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/representative-license_photo', $new3_file);
                $representative->license_photo = $new3_file;
            }

            if ($request->hasFile('fish_photo')) {
                if ($name4 !== null) {
                    unlink(public_path('/uploads/representative-fish_photo/') . $name4);
                }
                $file = $request->fish_photo;
                $new4_file = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/representative-fish_photo', $new4_file);
                $representative->fish_photo = $new4_file;
            }



            //      =================update    App\Models\user

            $user = $representative->user;
            $user->phone_number = $request->phone_number??$user->phone_number;
            $user->email = $request->email??$user->email;
            $user->update();

            //      =================update    App\Models\Representative

            $representative->name = $request->name??$representative->name;
            $representative->wallet = $request->wallet??$representative->wallet ;
            $representative->address = $request->address??$representative->address;
            $representative->area_id = $request->area_id??$representative->area_id;
            $representative->national_id = $request->national_id??$representative->national_id;

            $representative->update();
            DB::commit();

            return $this->returnData('representative', $representative, 'successfully');

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
