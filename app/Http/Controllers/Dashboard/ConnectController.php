<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Connect;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ConnectController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $connect = Connect::where('admin_id',$this->idAdmin())->with('admin')->get();

        return $this->returnData('connect', $connect, 'successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {


            $validation =Validator::make($request->all(),[

                'email'  => 'required|unique:connects|regex:/(.+)@(.+)\.(.+)/i',
                'email_2'  => 'nullable|unique:connects|regex:/(.+)@(.+)\.(.+)/i',
                'notes'  => 'nullable|string',
                'phone' => 'required|min:11|unique:connects',
                'phone_2' => 'nullable|min:11|unique:connects',
//                'user_id'  =>  'sometimes|required|exists:users,id'

            ]);
            if ($validation->fails())
            {
                return $this->returnError('errors', $validation->errors());
            }

             $user_id =  auth()->user()->id;
            $connect = Connect::create([

                'email' => $request->email,
                'user_id' => $user_id,
                'email_2' => $request->email_2,
                'phone_2' => $request->phone_2,
                'phone' => $request->phone,
                'notes' => $request->notes,
                'admin_id' => $this->idAdmin(),

            ]);
//            $connect->province;
            return $this->returnData('connect', $connect, 'successfully');

        } catch (\Exception $e) {

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
        try {

            $validation =Validator::make($request->all(),[

                'email'  => 'required|min:11|unique:connects,email' . ($id ? ",$id" : ''),
                'email_2'  => 'nullable|min:11|unique:connects,email_2' . ($id ? ",$id" : ''),
                'notes'  => 'nullable|string',
                'phone' => 'required|min:11|unique:connects,phone' . ($id ? ",$id" : ''),
                'phone_2' => 'nullable|min:11|unique:connects,phone_2' . ($id ? ",$id" : ''),

            ]);
            if ($validation->fails())
            {
                return $this->returnError('errors', $validation->errors());
            }
            $connect = Connect::where('admin_id',$this->idAdmin())->findOrFail($id);
            $user_id =  auth()->user()->id;
            $connect->user_id = $user_id;
            $connect->email = $request->email??$connect->email;
            $connect->email_2 = $request->email_2??$connect->email_2;
            $connect->notes = $request->notes??$connect->notes;
            $connect->phone  = $request->phone??$connect->phone;
            $connect->phone_2 = $request->phone_2??$connect->phone_2;
            $connect->admin_id = $this->idAdmin()??$this->idAdmin();
            $connect->update();

            return $this->returnData('connect', $connect, 'successfully');



        } catch (\Exception $e) {

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
        $area = Area::findOrFail($id);

        if (count($area->branch) > 0 && count($area->shipment) )
        {
            return response()->json("no delete",400);
        }else{
            $area->delete();
            return response()->json("deleted successfully");
        }
    }
}
