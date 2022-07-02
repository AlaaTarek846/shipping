<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CompleteStatuse;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CompleteStatuseController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $complete_statuse  = CompleteStatuse::latest()->paginate(15);
//        if (!$countries)
//            return $this-> returnError('لا يوجد دول ','001');
        return $this->returnData('complete_statuse', $complete_statuse, 'successfully');
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
                'status'  =>  'required|unique:complete_statuses',
            ]);
            if ($validation->fails())
            {
                return response()->json($validation->errors(), 422);
            }
            $complete_statuse = new CompleteStatuse($request->all());
            $complete_statuse->save();
            return $this->returnData('complete_statuse', $complete_statuse, 'successfully');

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
        $complete_statuse = CompleteStatuse::findOrFail($id);
        return $complete_statuse;
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
                'status'  =>  ['required', Rule::unique('complete_statuses')->ignore($id)],

            ]);
            if ($validation->fails())
            {
                return response()->json($validation->errors(), 422);
            }
            $complete_statuse = CompleteStatuse::findOrFail($id);
            $complete_statuse->update($request->all());

            return $this->returnData('complete_statuse', $complete_statuse, 'successfully');

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
        $complete_statuse = CompleteStatuse::findOrFail($id);

//        if (count($country->provinces) > 0)
//        {
//
//            return response()->json("no delete",400);
//        }else{

        $complete_statuse->delete();
            return response()->json("deleted successfully");
//        }
    }
}
