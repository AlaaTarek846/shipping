<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class IncomeController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $income = Income::with('children')->where([['income_id','=',null],['admin_id',$this->idAdmin()]])->get();

        return $this->returnData('income', $income, 'successfully');
    }

    public function index_income()
    {

        $income = Income::where('admin_id',$this->idAdmin())->get();

        return $this->returnData('income', $income, 'successfully');
    }

    public function mainIncome()
    {

        $income = Income::where([['income_id',null],['admin_id',$this->idAdmin()]])->get();

        return $this->returnData('income', $income, 'successfully');
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
                // 'income_id'  =>  'nullable|exists:incomes,id'
            ]);
            if ($validation->fails())
            {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }

            if($request->income_id == 0 || $request->income_id == null){


                $income = new Income([
                    'label' => $request->label,
                    'admin_id' => $this->idAdmin(),
                ]);
                $income->save();

            }else{

                $income = new Income([
                    'label' => $request->label,
                    'income_id' => $request->income_id,
                    'admin_id' => $this->idAdmin(),
                ]);
                $income->save();
            }

            return $this->returnData('income', $income, 'successfully');

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

        $income = Income::where('admin_id',$this->idAdmin())->find($id);
        return $this->returnData('income',$income, 'successfully');
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

                'label'  => ['required',Rule::unique('incomes')->ignore($id)],
                'income_id'  =>  'nullable|exists:incomes,id'

            ]);

            if ($validation->fails())
            {
//                    return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }
            $income = Income::where('admin_id',$this->idAdmin())->findOrFail($id);
            $income->label = $request->label??$income->label;
            $income->income_id = $request->income_id??$income->income_id;
            $income->admin_id = $this->idAdmin()??$this->idAdmin();
            $income->update();

            return $this->returnData('income', $income, 'successfully');



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
        $income = Income::where('admin_id',$this->idAdmin())->findOrFail($id);

        if (count($income->children) > 0 || count($income->offer) > 0  )
        {
            return response()->json("no deleted ");

        }else{
            $income->delete();
            return response()->json("deleted successfully");
        }

    }
}
