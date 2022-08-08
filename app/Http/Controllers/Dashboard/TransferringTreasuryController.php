<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\TransferringTreasury;
use Illuminate\Support\Facades\Validator;

class TransferringTreasuryController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transferring_treasury = TransferringTreasury::where('admin_id',$this->idAdmin())->with('user','treasury_start','treasury_end')->get();
        return $this->returnData('transferring_treasury', $transferring_treasury, 'successfully');

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

                'price'  =>  'required|regex:/^\d+(\.\d{1,2})?$/',
                'treasurie_start_id'  =>  'required|exists:treasuries,id',
                'treasurie_end_id'  =>  'required|exists:treasuries,id|different:treasurie_start_id',

            ]);

            if ($validation->fails())
            {
                return $this->returnError('errors', $validation->errors());
            }
             $user_id = auth()->user()->id;

            $transferring_treasury = TransferringTreasury::create([

                'price' => $request->price,
                'user_id' => $user_id,
                'treasurie_start_id' => $request->treasurie_start_id,
                'treasurie_end_id' => $request->treasurie_end_id,
                'admin_id' => $this->idAdmin(),

            ]);



            return $this->returnData('transferring_treasury', $transferring_treasury, 'successfully');

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

                'price'  =>  'required|regex:/^\d+(\.\d{1,2})?$/',
                'treasurie_start_id'  =>  'required|exists:treasuries,id',
                'treasurie_end_id'  =>  'required|exists:treasuries,id',


            ]);
            if ($validation->fails())
            {
                return $this->returnError('errors', $validation->errors());
            }
            $transferring_treasury = TransferringTreasury::where('admin_id',$this->idAdmin())->findOrFail($id);

            $user_id = auth()->user()->id;
            $transferring_treasury->user_id = $user_id;
            $transferring_treasury->price = $request->price;
            $transferring_treasury->treasurie_start_id = $request->treasurie_start_id;
            $transferring_treasury->treasurie_end_id = $request->treasurie_end_id;
            $transferring_treasury->admin_id = $this->idAdmin()??$this->idAdmin();

            $transferring_treasury->update();

            return $this->returnData('transferring_treasury', $transferring_treasury, 'successfully');

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
        $transferring_treasury = TransferringTreasury::where('admin_id',$this->idAdmin())->findOrFail($id);

        $transferring_treasury->delete();
        return response()->json("deleted successfully");
    }
}
