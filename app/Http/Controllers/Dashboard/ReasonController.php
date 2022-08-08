<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Reason;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ReasonController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reason = Reason::where('admin_id',$this->idAdmin())->with('shipment')->get();

        return $this->returnData('reason', $reason, 'successfully');

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
                'name'=> 'required|unique:reasons',
            ]);
            if ($validation->fails())
            {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }
            $reason = new Reason([
                'name' => $request->name,
                'admin_id' => $this->idAdmin(),
            ]);
            $reason->save();
            return $this->returnData('reason', $reason, 'successfully');

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
        $reason = Reason::where('admin_id',$this->idAdmin())->findOrFail($id);
        return $reason;
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
                'name'=> ['required', Rule::unique('reasons','name')->ignore($id)],
            ]);
            if ($validation->fails())
            {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }
            $reason = Reason::where('admin_id',$this->idAdmin())->findOrFail($id);
            $reason->name = $request->name??$reason->name;
            $reason->admin_id = $this->idAdmin()??$this->idAdmin();
            $reason->update();

            return $this->returnData('reason', $reason, 'successfully');
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
        $reason = Reason::where('admin_id',$this->idAdmin())->findOrFail($id);

        $reason->delete();
        return response()->json("deleted successfully");
    }
}
