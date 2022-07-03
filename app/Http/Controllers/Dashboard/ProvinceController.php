<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Province;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProvinceController extends Controller
{
    use GeneralTrait;



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = Province::where('admin_id',$this->idAdmin())->with('country','admin')->get();

        return $this->returnData('provinces', $provinces, 'successfully');

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
                    'name'  =>  'required|unique:provinces',
                    'country_id'  =>  'required|exists:countries,id'
                ]);
                if ($validation->fails())
                {
//                    return response()->json($validation->errors(), 422);
                    return $this->returnError('errors', $validation->errors());

                }

                $province = new Province([
                    'name' => $request->name,
                    'country_id' => $request->country_id,
                    'admin_id' => $this->idAdmin(),

                ]);
                $province->save();
                $province->country;

                return $this->returnData('province',$province, 'successfully');


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
        $province = Province::where('admin_id',$this->idAdmin())->with('country','admin')->findOrFail($id);
        return $this->returnData('province',$province, 'successfully');
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
                'name'  =>  ['required',Rule::unique('provinces')->ignore($id)],
                'country_id'  =>  'required|exists:countries,id'
            ]);
            if ($validation->fails())
            {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }
            $province = Province::where('admin_id',$this->idAdmin())->findOrFail($id);
            $province->name = $request->name??$province->name;
            $province->country_id = $request->country_id??$province->country_id;
            $province->admin_id = $this->idAdmin()??$this->idAdmin();
            $province->update();
            $province->country;

            return $this->returnData('province', $province, 'successfully');
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
        $province = Province::where('admin_id',$this->idAdmin())->findOrFail($id);


        if (count($province->areas) > 0)
        {
            return response()->json("no delete",400);
        }else{

            $province->delete();
            return response()->json("deleted successfully");
        }
    }
}
