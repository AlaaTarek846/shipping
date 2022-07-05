<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;
use Exception;

class ClientController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = Client::where('admin_id',$this->idAdmin())->with('user','citie','admin')->latest()->paginate(15);

        return $this->returnData('clients', $client, 'successfully');

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

            //      =================validate on Table  Models Client

            $validation = Validator::make($request->all(), [

                'name' => 'required|string',
                'email_2' => 'nullable|email|unique:users',
                'address' => 'required|string',
                'phone' => 'required|min:11|unique:clients',
                'phone_2' => 'min:11|unique:clients|nullable',
                'photo' => 'mimes:jpeg:jpeg,jpg,png,gif|nullable',
                'google_location' => 'string|nullable',
                'user_id'  =>  'exists:users,id|nullable',
                'city_id'  =>  'nullable|exists:cities,id',

            ]);
            if ($validation->fails()) {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }

            //      =================upload  photo  App\Models\Client

            if ($request->hasFile('photo')) {
                $file = $request->photo;
                $new_file = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/client', $new_file);
            }else{
                $new_file = null;
            }

           //      =================App\Models\Client


            $client = Client::create([
                "user_id" => $request->user_id,
                'name' => $request->name,
                'email_2' => $request->email_2,
                'address' => $request->address,
                'google_location' => $request->google_location,
                'phone' => $request->phone,
                'phone_2' => $request->phone_2,
                'city_id' => $request->city_id,
                'admin_id' => $this->idAdmin(),
                'photo' => $new_file,
            ]);

            DB::commit();

            return $this->returnData('client', $client, 'successfully');

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
        $client = Client::where('admin_id',$this->idAdmin())->findOrFail($id);

        return $this->returnData('client', $client, 'successfully');

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

            //      =================update validate on Table  Models  Client

            $validation = Validator::make($request->all(), [

                'name' => 'required|string',
                'email_2' => 'nullable|email|unique:clients,email_2'. ($id ? ",$id" : ''),
                'address' => 'required|string',
                'phone' => 'required|min:11|unique:clients,phone' . ($id ? ",$id" : ''),
                'phone_2' => 'nullable|min:11|unique:clients,phone_2' . ($id ? ",$id" : ''),
                'photo' => 'nullable|mimes:jpeg:jpeg,jpg,png,gif',
                'google_location' => 'string|nullable',
                'user_id'  =>  'exists:users,id|nullable',
                'city_id'  =>  'nullable|exists:cities,id',

            ]);
            if ($validation->fails()) {
                return $this->returnError('errors', $validation->errors());

//                return response()->json($validation->errors(), 422);
            }

            //      =================update  photo  App\Models\Client

            $client = Client::where('admin_id',$this->idAdmin())->findOrFail($id);
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

            //      =================update    App\Models\Client

            $client->name = $request->name??$client->name;
            $client->address = $request->address??$client->address;
            $client->google_location = $request->google_location??$client->google_location;
            $client->phone = $request->phone??$client->phone;
            $client->phone_2 = $request->phone_2??$client->phone_2;
            $client->email_2 = $request->email_2??$client->email_2;
            $client->user_id = $request->user_id??$client->user_id;
            $client->city_id = $request->city_id??$client->city_id;
            $client->admin_id = $this->idAdmin()??$this->idAdmin();


            $client->update();
            DB::commit();

            return $this->returnData('client', $client, 'successfully');

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

        $client = Client::where('admin_id',$this->idAdmin())->find($id);
        if($client){

            if (count($client->shipment) > 0 ){

                return response()->json("no deleted ");

            }else{

                if ($client->photo !== null) {
                    unlink(public_path('uploads/client/') . $client->photo);
                }
                $client->destroy($id);
                return response()->json('deleted successfully');
            }


        }else{

            return response()->json('no deleted successfully');

        }



    }



}
