<?php

namespace App\Http\Controllers\AuthUser;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{
    use GeneralTrait;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register','getDownload']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
//            return response()->json($validator->errors(), 422);
            return $this->returnError('errors', $validator->errors());

        }
        $user_email = User::where('email', $request->email)->first();
        if ($user_email) {
            if (Hash::check($request->password, $user_email->password)) {
                if (!$token = auth()->attempt($validator->validated())) {

                    return response()->json(['error' => 'Unauthorized'], 401);
                }
                auth()->user()->update([
                    'token' => $request->header('token'),
                ]);

                return $this->createNewToken($token);

            } else {


                return response()->json('Not Found Password','422');

            }
        }else{

            return response()->json('Not Found email','422');

        }

//        if (! $token = auth()->attempt($validator->validated())) {
//            return response()->json(['error' => 'Unauthorized'], 401);
//        }
//        return $this->createNewToken($token);
    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);
        if($validator->fails()){

//            return response()->json($validator->errors()->toJson(), 400);
            return $this->returnError('errors', $validator->errors());

        }
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
//        return response()->json(auth()->user());

        $user = auth()->user();
        $user->roles ;

        return response()->json($user);
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
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

            return response()->json("sorry the old password is not correct", 400);

        }
    }
    public function updateProfile(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            //      =================update validate on Table  Models User and Client
            $admin = Admin::findOrFail($id);
            $user_id = User::find($admin->user_id);


            $validation = \Illuminate\Support\Facades\Validator::make($request->all(), [

                'name' => 'required',
                'email' => 'required|email|unique:users,email' . ($user_id->id ? ",$user_id->id" : ''),
                'photo' => 'mimes:jpeg:jpeg,jpg,png,gif|nullable',

            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }

            //      =================update  photo  App\Models\Client

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

            $user->email = $request->email;
            $user->update();

            //      =================update    App\Models\user
            //
            $admin->name = $request->name;


            $admin->update();
            DB::commit();
            //        return response()->json($admin);
            return $this->returnData('admin', $admin, 'successfully');

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function getDownload()
    {
        //PDF file is stored under project/public/download/info.pdf

        $file= public_path(). "/uploads/Bookali-Sheet-2.xlsx";

        $headers = array(
            'Content-Type: application/apk',
        );

        return Response::download($file, 'Bookali-Sheet-2.xlsx', $headers);
    }


}
