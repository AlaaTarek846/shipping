<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyShipmentDetails;
use App\Models\Shipment;
use App\Models\User;
use App\Models\UserApiK;
use App\Models\Notification;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    use GeneralTrait;

    public function index_notification_company()
    {
        $user_id = auth()->user()->id;
        $notification_company = Notification::where([['user_id',$user_id],['admin_id',$this->idAdmin()]])->with( 'user','admin')->get();

        return $this->returnData('notification_company', $notification_company, 'successfully');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $companies = Company::where('admin_id',$this->idAdmin())->with('user.userApiK','citie','branch','company_shipment_details','company_shipping_area_prices.area','branch','payment_type')->latest()->paginate(15);
        foreach ($companies as $company){
            $current_shipment = Shipment::where([
                ['sender_id' , $company->user->id],
                ['shipment_status_id' , 1 ],
                ['admin_id',$this->idAdmin()]
            ])->orWhere([
                ['sender_id' , $company->user->id],
                ['shipment_status_id' , 2 ],
                ['admin_id',$this->idAdmin()]

            ])->orWhere([
                ['sender_id' , $company->user->id],
                ['shipment_status_id' , 3 ],
                ['admin_id',$this->idAdmin()]

            ])->orWhere([
                ['sender_id' , $company->user->id],
                ['shipment_status_id' , 4 ],
                ['admin_id',$this->idAdmin()]

            ])->orWhere([
                ['sender_id' , $company->user->id],
                ['shipment_status_id' , 5 ],
                ['admin_id',$this->idAdmin()]

            ])->orWhere([
                ['sender_id' , $company->user->id],
                ['shipment_status_id' , 6 ],
                ['admin_id',$this->idAdmin()]

            ])->orWhere([
                ['sender_id' , $company->user->id],
                ['shipment_status_id' , 12 ],
                ['admin_id',$this->idAdmin()]

            ])->count();

            $value_of_shipment = Shipment::where([
                ['shipment_status_id',2],
                ['sender_id' , $company->user->id],
                ['admin_id',$this->idAdmin()]

            ])->orWhere([
                ['shipment_status_id' , 3],
                ['sender_id' , $company->user->id],
                ['admin_id',$this->idAdmin()]

            ])->orWhere([
                ['shipment_status_id' , 4],
                ['sender_id' , $company->user->id],
                ['admin_id',$this->idAdmin()]

            ])->orWhere([
                ['shipment_status_id' , 5],
                ['sender_id' , $company->user->id],
                ['admin_id',$this->idAdmin()]

            ])->orWhere([
                ['shipment_status_id' , 6],
                ['sender_id' , $company->user->id],
                ['admin_id',$this->idAdmin()]

            ])->get()->sum('total_shipment');

            $balance = CompanyShipmentDetails::where([
                ['company_id',$company->id],
                ['company_account_id',null],
                ['admin_id',$this->idAdmin()]

            ])->sum('shipment_price');

            $company->current_shipment = $current_shipment;

            $company->value_of_shipment = $value_of_shipment;

            $company->balance = $balance;
        }

        return $this->returnData('companies', $companies, 'successfully');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DB::beginTransaction();

        try {

            //      =================validate on Table  Models User and Company

            $validation = Validator::make($request->all(), [

                'name' => 'required|string',
                'address' => 'required|string',
                'photo' => 'nullable|mimes:jpeg:jpeg,jpg,png,gif|nullable',
                'phone' => 'nullable|min:11',
                'flyer_stock' => 'nullable|integer',
                'pick_up_fee' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
                'minimum_sunday_pick_up' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
                'google_location' => 'nullable|string',
                'shipment_type' => 'nullable|string',
//                'payment_method' => 'nullable|string',
                'email' => 'nullable|email|unique:users',
                'password' => 'required|min:8|confirmed',
                'phone_number' => 'required|min:11|unique:users',
                'city_id'  =>  'required|exists:cities,id',
                'branch_id'  =>  'required|exists:branches,id',
                'payment_type_id'  =>  'required|exists:payment_types,id',


            ]);
            if ($validation->fails()) {
                return $this->returnError('errors', $validation->errors());
            }

            //      =================App\Models\User

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request['password']),
                'phone_number' => $request->phone_number,
                'user_type' => 'company',

            ]);

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

            //      =================App\Models\company

            $company = Company::create([
                "user_id" => $user->id,
                'name' => $request->name,
                'address' => $request->address,
                'google_location' => $request->google_location??null,
                'flyer_stock' => $request->flyer_stock??null,
                'pick_up_fee' => $request->pick_up_fee??null,
                'minimum_sunday_pick_up' => $request->minimum_sunday_pick_up??null,
                'shipment_type' => $request->shipment_type??null,
                'payment_type_id' => $request->payment_type_id??null,
                'phone' => $request->phone??null,
                'city_id' => $request->city_id,
                'branch_id' => $request->branch_id,
                'admin_id' => $this->idAdmin(),
                'photo' => $new_file,

            ]);

            $company->user;
            $company->user->userApiK;

            DB::commit();

            return $this->returnData('company', $company, 'successfully');

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
        $company = Company::where('admin_id',$this->idAdmin())->with('user','admin')->findOrFail($id);

        return $this->returnData('company', $company, 'successfully');

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

            $company = Company::where('admin_id',$this->idAdmin())->findOrFail($id);
            $user_id = User::find($company->user_id);

            //      =================update validate on Table  Models User and Company

            $validation = Validator::make($request->all(), [

                'name' => 'required|string',
                'address' => 'required|string',
                'phone' => 'nullable|min:11|unique:companies,phone' . ($id ? ",$id" : ''),
                'photo' => 'nullable|mimes:jpeg:jpeg,jpg,png,gif',
                'google_location' => 'nullable|string',
                'email' => 'required|email|unique:users,email' . ($user_id->id ? ",$user_id->id" : ''),
                'flyer_stock' => 'nullable|integer',
                'pick_up_fee' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
                'minimum_sunday_pick_up' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
                'shipment_type' => 'nullable|string',
//                'payment_method' => 'nullable|string',
                'phone_number' => 'required|min:11|unique:users,phone_number' . ($user_id->id ? ",$user_id->id" : ''),
                'city_id'  =>  'required|exists:cities,id',
                'branch_id'  =>  'required|exists:branches,id',
                'payment_type_id'  =>  'required|exists:payment_types,id',


            ]);
            if ($validation->fails()) {

                return $this->returnError('errors', $validation->errors());
            }

            //      =================update  photo  App\Models\Company

            $company = Company::where('admin_id',$this->idAdmin())->findOrFail($id);
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
            $user->phone_number = $request->phone??$user->phone_number;
            $user->email = $request->email??$user->email;
            $user->update();

            //      =================update    App\Models\Company

            $company->name = $request->name??$company->name;
            $company->address = $request->address??$company->address;
            $company->google_location = $request->google_location??$company->google_location;
            $company->phone = $request->phone??$company->phone;
            $company->flyer_stock = $request->flyer_stock??$company->flyer_stock;
            $company->pick_up_fee = $request->pick_up_fee??$company->pick_up_fee;
            $company->minimum_sunday_pick_up = $request->minimum_sunday_pick_up??$company->minimum_sunday_pick_up;
            $company->shipment_type = $request->shipment_type??$company->shipment_type;
            $company->payment_type_id = $request->payment_type_id??$company->payment_type_id;
            $company->phone = $request->phone??$company->phone;
            $company->city_id = $request->city_id??$company->city_id;
            $company->branch_id = $request->branch_id??$company->branch_id;
            $company->admin_id = $this->idAdmin()??$company->admin_id;



            $company->update();
            DB::commit();

            return $this->returnData('company', $company, 'successfully');

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


        $company = Company::where('admin_id',$this->idAdmin())->find($id);
        if (count($company->storage_system) > 0 || count($company->offer) > 0 || count($company->weight_company) > 0 || count($company->company_account) > 0 || count($company->company_shipment_details) > 0 )
        {
            return response()->json("no deleted ");

        }else{
            if ($company->photo !== null) {
                unlink(public_path('uploads/company/') . $company->photo);
            }
            $user = User::find($company->user_id);
            $company->destroy($id);
            $user->delete();
            return response()->json('deleted successfully');
        }

    }



}
