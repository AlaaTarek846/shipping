<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CountryController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//$this->idAdmin() where('admin_id',$this->idAdmin())->

    public function index()
    {
        $countries  = Country::where('admin_id',$this->idAdmin())->with('admin')->get();

        return $this->returnData('Country', $countries, 'successfully');
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
                'name'  =>  'required|string|unique:countries',
            ]);

            if ($validation->fails())
            {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }

            $country = new Country([
                'name' => $request->name,
                'admin_id' => $this->idAdmin(),

            ]);
            $country->save();

            return $this->returnData('Country', $country, 'successfully');

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
        $country = Country::where('admin_id',$this->idAdmin())->findOrFail($id);
        return $country;
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
                'name'  =>  ['required', Rule::unique('countries')->ignore($id)],
            ]);

            if ($validation->fails())
            {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }

            $country = Country::where('admin_id',$this->idAdmin())->findOrFail($id);
            $country->name = $request->name??$country->name;
            $country->admin_id = $this->idAdmin()??$this->idAdmin();
            $country->update();

            return $this->returnData('Country', $country, 'successfully');

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
        $country = Country::where('admin_id',$this->idAdmin())->findOrFail($id);

        if (count($country->provinces) > 0)
        {

            return response()->json("no delete",400);
        }else{

            $country->delete();
            return response()->json("deleted successfully");
        }
    }
}
