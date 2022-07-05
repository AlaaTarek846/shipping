<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\PickUp;
use App\Models\TransportType;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PickUpController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id =  auth()->user()->id;

        $pickup = PickUp::with('transporttype','admin')->where([['user_id',$user_id],['admin_id',$this->idAdmin()]])->latest()->paginate(15);

        return $this->returnData('pickup', $pickup, 'successfully');
    }

    public function index_admin()
    {

        $pickup = PickUp::where('admin_id',$this->idAdmin())->with('transporttype','admin')->get();

        return $this->returnData('pickup', $pickup, 'successfully');
    }


    public function allStatusNoactiveUp()
    {

        $pickup = PickUp::with('transporttype','admin')->where([['status',0],['admin_id',$this->idAdmin()]])->get();

        return $this->returnData('pickup', $pickup, 'successfully');
    }

    public function allStatusUp()
    {

        $pickup = PickUp::where('admin_id',$this->idAdmin())->with('transporttype','admin')->get();

        return $this->returnData('pickup', $pickup, 'successfully');
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

                'qty'  => 'required|integer',
                'notes'  => 'nullable|string',
                'transport_type_id'  =>  'required|exists:transport_types,id',

            ]);
            if ($validation->fails())
            {
                return $this->returnError('errors', $validation->errors());
            }

            $user_id =  auth()->user()->id;
            $pickup = PickUp::create([

                'qty' => $request->qty,
                'user_id' => $user_id,
                'notes' => $request->notes,
                'transport_type_id' => $request->transport_type_id,
                'admin_id' => $this->idAdmin(),


            ]);
            $pickup->transporttype;

            return $this->returnData('pickup', $pickup, 'successfully');

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

                'qty'  => 'required|integer',
                'notes'  => 'nullable|string',
                'transport_type_id'  =>  'required|exists:transport_types,id',

            ]);
            if ($validation->fails())
            {
                return $this->returnError('errors', $validation->errors());
            }
            $pickup = PickUp::where('admin_id',$this->idAdmin())->findOrFail($id);

            $user_id =  auth()->user()->id;
            $pickup->user_id = $user_id;
            $pickup->qty = $request->qty;
            $pickup->transport_type_id = $request->transport_type_id;
            $pickup->admin_id = $this->idAdmin()??$this->idAdmin();


            if($pickup->notes == ''){
                $pickup->notes = $request->notes;
            }
            $pickup->transporttype;
            $pickup->update();

            return $this->returnData('pickup', $pickup, 'successfully');

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
        $pickup = PickUp::where('admin_id',$this->idAdmin())->findOrFail($id);

        $pickup->delete();
        return response()->json("deleted successfully");

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function transporttype()
    {
        $transport_type  = TransportType::all();

        return $this->returnData('transport_type', $transport_type, 'successfully');
    }


    public function status_active($id)
    {
        $pickup = PickUp::findOrFail($id);
        $pickup->update([
            'status' => 1
        ]);
        return $this->returnData('pickup', $pickup, 'successfully');

    }

    public function all_pickUp_active()
    {
        $user_id =  auth()->user()->id;

        $pickup = PickUp::with('transporttype')->where([['user_id',$user_id],['status',1]])->latest()->paginate(15);

        return $this->returnData('pickup', $pickup, 'successfully');

    }



}
