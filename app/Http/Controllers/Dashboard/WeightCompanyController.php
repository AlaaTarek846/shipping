<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\WeightCompany;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class WeightCompanyController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $weight_company  = WeightCompany::with('company')->where('company_id',$id)->get();

        return $this->returnData('weight_company', $weight_company, 'successfully');
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
                'type'  =>  'nullable|unique:shipment_types',
                'limit'  =>  'required|integer',
                'price'  =>  'required|regex:/^\d+(\.\d{1,2})?$/',
                'company_id'  =>  'required|exists:companies,id',
            ]);

            if ($validation->fails())
            {
                return $this->returnError('errors', $validation->errors());
            }
            $weight_company =  WeightCompany::where('company_id',$request->company_id)->first();
            if($weight_company){
                $weight_company->update([

                    'type' => $request->type,
                    'limit' => $request->limit,
                    'price' => $request->price,
                    'company_id' => $request->company_id,

                ]);
            }else{

                $weight_company = new WeightCompany($request->all());
                $weight_company->save();
            }
            $weight_company->company;

            return $this->returnData('weight', $weight_company, 'successfully');

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
        $weight_company = Weight::findOrFail($id);
        return $weight_company;
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
//                'type'  =>  ['required', Rule::unique('shipment_types')->ignore($id)],
                'limit'  =>  'required|nullable|integer',
                'price'  =>  'required|regex:/^\d+(\.\d{1,2})?$/',
                'company_id'  =>  'required|exists:companies,id',

            ]);
            if ($validation->fails())
            {
                return $this->returnError('errors', $validation->errors());
            }

            $weight_company = WeightCompany::findOrFail($id);
            $weight_company->update($request->all());

            return $this->returnData('weight_company', $weight_company, 'successfully');

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
        $weight_company = WeightCompany::findOrFail($id);

        $weight_company->delete();
        return response()->json("deleted successfully");
    }
}
