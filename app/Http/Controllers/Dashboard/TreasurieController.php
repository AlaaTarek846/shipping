<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Treasury;

use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TreasurieController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {

        $treasuries = Treasury::where([['treasury_id',null],['admin_id',$this->idAdmin()]])->with('children')->get();

        return $this->returnData('treasuries', $treasuries, 'successfully');
    }
    public function index_treasuries()
    {

        $treasuries = Treasury::where('admin_id',$this->idAdmin())->get();

        return $this->returnData('treasuries', $treasuries, 'successfully');
    }

    public function id_children_treasuries($id){

        $treasuries = Treasury::where([['treasury_id',$id],['admin_id',$this->idAdmin()]])->get();

        return $this->returnData('children_treasuries', $treasuries, 'successfully');
    }

    public function mainTreasury()
    {

        $treasuries = Treasury::where([['treasury_id',null],['admin_id',$this->idAdmin()]])->get();

        return $this->returnData('treasuries', $treasuries, 'successfully');
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
                'label'  => 'required|unique:treasuries',
                // 'treasury_id'  =>  'nullable|exists:treasuries,id'
            ]);
            if ($validation->fails())
            {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }

            if($request->treasury_id == 0 || $request->treasury_id == null){

                $treasuries = new Treasury([
                    'label' => $request->label,
                    'admin_id' => $this->idAdmin(),
                ]);
                $treasuries->save();

            }else{

                $treasuries = new Treasury([
                    'label' => $request->label,
                    'treasury_id' => $request->treasury_id,
                    'admin_id' => $this->idAdmin(),
                ]);
                $treasuries->save();
            }
            return $this->returnData('treasuries', $treasuries, 'successfully');

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
        $treasuries = Treasury::where('admin_id',$this->idAdmin())->with('children')->find($id);
        return $this->returnData('treasuries',$treasuries, 'successfully');
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

                'label'  => ['required',Rule::unique('treasuries')->ignore($id)],
                'treasury_id'  =>  'nullable|exists:treasuries,id'
            ]);


            if ($validation->fails())
            {
//                    return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }
            $treasuries = Treasury::where('admin_id',$this->idAdmin())->findOrFail($id);
            $treasuries->label = $request->label??$treasuries->label;
            $treasuries->treasury_id = $request->treasury_id??$treasuries->treasury_id;
            $treasuries->admin_id = $this->idAdmin()??$this->idAdmin();
            $treasuries->update();
            $treasuries->treasury_child;

            return $this->returnData('treasuries', $treasuries, 'successfully');



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
        $treasuries = Treasury::where('admin_id',$this->idAdmin())->findOrFail($id);

        $treasuries->delete();
        return response()->json("deleted successfully");

    }
}
