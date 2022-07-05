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
        $weight_company  = WeightCompany::with('company','admin')->where([['company_id',$id],['admin_id',$this->idAdmin()]])->get();

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
            $weight_company =  WeightCompany::where([['company_id',$request->company_id],['admin_id',$this->idAdmin()]])->first();
            if($weight_company){
                $weight_company->update([

                    'type' => $request->type,
                    'limit' => $request->limit,
                    'price' => $request->price,
                    'company_id' => $request->company_id,
                    'admin_id' => $this->idAdmin(),


                ]);
            }else{

                $weight_company = new WeightCompany([
                    'type' => $request->type,
                    'limit' => $request->limit,
                    'price' => $request->price,
                    'company_id' => $request->company_id,
                    'admin_id' => $this->idAdmin(),

                ]);
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
        $weight_company = Weight::where('admin_id',$this->idAdmin())->findOrFail($id);
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

            $weight_company = WeightCompany::where('admin_id',$this->idAdmin())->findOrFail($id);
            $weight_company->type  = $request->type??$weight_company->type;
            $weight_company->limit  = $request->limit??$weight_company->limit;
            $weight_company->price = $request->price??$weight_company->price;
            $weight_company->company_id = $request->company_id??$weight_company->company_id;
            $weight_company->admin_id = $this->idAdmin()??$this->idAdmin();

            $weight_company->update();

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
        $weight_company = WeightCompany::where('admin_id',$this->idAdmin())->findOrFail($id);

        $weight_company->delete();
        return response()->json("deleted successfully");
    }
}
