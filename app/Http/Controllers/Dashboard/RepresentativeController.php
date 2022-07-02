<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\RepresentativeAccountDetail;
use App\Models\Shipment;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\Representative;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RepresentativeController extends Controller
{

    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index_notification_representative()
    {
        $user_id = auth()->user()->id;
        $notification_representative = Notification::where('user_id',$user_id)->with( 'user')->get();

        return $this->returnData('notification_representative', $notification_representative, 'successfully');
    }

    public function index()
    {
        $representative = Representative::where('admin_id',$this->idAdmin())->with('user','citie')->get();

        foreach ($representative as $representatives){

            $count_Shipment = Shipment::where([
                ['shipment_status_id',2],
                ['representative_id',$representatives->id],
                ['admin_id',$this->idAdmin()],
            ])->orWhere([
                ['shipment_status_id' , 3],
                ['representative_id',$representatives->id],
                ['admin_id',$this->idAdmin()],

            ])->orWhere([
                ['shipment_status_id' , 4],
                ['representative_id',$representatives->id],
                ['admin_id',$this->idAdmin()],

            ])->orWhere([
                ['shipment_status_id' , 5],
                ['representative_id',$representatives->id],
                ['admin_id',$this->idAdmin()],

            ])->orWhere([
                ['shipment_status_id' , 6],
                ['representative_id',$representatives->id],
                ['admin_id',$this->idAdmin()],

            ])->count();

            $value_of_shipment =  Shipment::where([
                ['shipment_status_id',2],
                ['representative_id',$representatives->id],
                ['admin_id',$this->idAdmin()],

            ])->orWhere([
                ['shipment_status_id' , 3],
                ['representative_id',$representatives->id],
                ['admin_id',$this->idAdmin()],

            ])->orWhere([
                ['shipment_status_id' , 4],
                ['representative_id',$representatives->id],
                ['admin_id',$this->idAdmin()],

            ])->orWhere([
                ['shipment_status_id' , 5],
                ['representative_id',$representatives->id],
                ['admin_id',$this->idAdmin()],

            ])->orWhere([
                ['shipment_status_id' , 6],
                ['representative_id',$representatives->id],
                ['admin_id',$this->idAdmin()],

            ])->sum('shipping_price');

            $total_collection_balance =  RepresentativeAccountDetail::where([
                ['representative_id',$representatives->id],
                ['representative_account_id',null],
                ['admin_id',$this->idAdmin()],
            ])->sum('collection_balance');

            $representatives->current_shipment = $count_Shipment;
            $representatives->value_of_shipment = $value_of_shipment;
            $representatives->balance = $total_collection_balance;
        }

        return $this->returnData('representative', $representative, 'successfully');


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

            //      =================validate on Table  Models User and Representative

            $validation = Validator::make($request->all(), [

                'name' => 'required|string',
                'address' => 'required|string',
                'wallet' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
                'salary' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'national_id' => 'required|regex:/^\d{14}$/|unique:representatives',
//                'email' => 'nullable|email|unique:users',
                'password' => 'required|min:8|confirmed',
                'phone_number' => 'required|min:11|unique:users',
                'photo' => 'mimes:jpeg:jpeg,jpg,png,gif|nullable',
                'cv' => 'mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf|nullable',
                'license_photo' => 'mimes:jpeg:jpeg,jpg,png,gif|nullable',
                'fish_photo' => 'mimes:jpeg:jpeg,jpg,png,gif|nullable',
                'city_id'  =>  'required|exists:cities,id',

            ]);
            if ($validation->fails()) {
                return $this->returnError('errors', $validation->errors());
            }

            //      =================App\Models\User

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request['password']),
                'phone_number' => $request->phone_number,
                'user_type' => 'representative',

            ]);

            //      =================upload  photo  App\Models\Representative-photo

            if ($request->hasFile('photo')) {
                $file = $request->photo;
                $new_file = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/representative-photo', $new_file);
            }else{
                $new_file = null;
            }

            //      =================upload  Cv  App\Models\Representative

            if ($request->hasFile('cv')) {
                $file = $request->cv;
                $new2_file = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/representative-cv', $new2_file);
            }else{
                $new2_file = null;
            }

            //      =================upload  license_photo  App\Models\Representative

            if ($request->hasFile('license_photo')) {
                $file = $request->license_photo;
                $new3_file = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/representative-license_photo', $new3_file);
            }else{
                $new3_file = null;
            }
            //      =================upload  fish_photo  App\Models\Representative

            if ($request->hasFile('fish_photo')) {
                $file = $request->fish_photo;
                $new4_file = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/representative-fish_photo', $new4_file);
            }else{
                $new4_file = null;
            }

            //      =================App\Models\Representative

            $representative = Representative::create([
                "user_id" => $user->id,
                'name' => $request->name,
                'address' => $request->address,
                'wallet' => $request->wallet,
                'salary' => $request->salary,
                'national_id' => $request->national_id,
                'commission' => $request->commission,
                'city_id' => $request->city_id,
                'admin_id' => $this->idAdmin(),
                'photo' => $new_file,
                'cv' => $new2_file,
                'license_photo' => $new3_file,
                'fish_photo' => $new4_file,

            ]);
            $representative->user;
            DB::commit();

            return $this->returnData('representative', $representative, 'successfully');

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
        $representative = Representative::where('admin_id',$this->idAdmin())->with('user')->findOrFail($id);

        return $this->returnData('representative', $representative, 'successfully');
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

            $representative = Representative::where('admin_id',$this->idAdmin())->findOrFail($id);
            $user_id = User::find($representative->user_id);

            //      =================update validate on Table  Models User and Representative

            $validation = Validator::make($request->all(), [

                'name' => 'required|string',
                'address' => 'required|string',
                'national_id' => 'nullable|min:11|unique:representatives,national_id' . ($id ? ",$id" : ''),
                'salary' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'wallet' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
//                'commission' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
                'email' => 'nullable|email|unique:users,email' . ($user_id->id ? ",$user_id->id" : ''),
                'phone_number' => 'required|min:11|unique:users,phone_number'. ($user_id->id ? ",$user_id->id" : ''),
                'photo' => 'mimes:jpeg:jpeg,jpg,png,gif',
                'cv' => 'mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf',
                'license_photo' => 'mimes:jpeg:jpeg,jpg,png,gif',
                'fish_photo' => 'mimes:jpeg:jpeg,jpg,png,gif',
                'city_id'  =>  'required|exists:cities,id',


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
            $representative->salary = $request->salary??$representative->salary;
            $representative->commission = $request->commission??$representative->commission;
            $representative->city_id = $request->city_id??$representative->city_id;
            $representative->national_id = $request->national_id??$representative->national_id;
            $representative->national_id = $request->national_id??$representative->national_id;
            $representative->admin_id = $this->idAdmin()??$this->idAdmin();

            $representative->update();
            DB::commit();

            return $this->returnData('representative', $representative, 'successfully');

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
        $representative = Representative::where('admin_id',$this->idAdmin())->find($id);


        if (count($representative->shipment) > 0  || count($representative->shipmenttransfer) > 0 || count($representative->representative_move) > 0 || count($representative->representative_area) > 0 || count($representative->message_representative) > 0 || count($representative->representative_account) > 0 || count($representative->representative_account_detail) > 0 ){

            return response()->json("no deleted ");

        }else{
            if ($representative->photo !== null) {
                unlink(public_path('uploads/representative-photo/') . $representative->photo);
            }
            if ($representative->cv !== null) {
                unlink(public_path('uploads/representative-cv/') . $representative->cv);
            }
            $user = User::find($representative->user_id);
            $representative->destroy($id);
            $user->delete();
            return response()->json('deleted successfully');

        }

    }
}
