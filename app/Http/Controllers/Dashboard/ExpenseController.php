<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ExpenseController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $expense = Expense::with('children')->where([['expense_id',null],['admin_id',$this->idAdmin()]])->get();

        return $this->returnData('expense', $expense, 'successfully');
    }

    public function index_expense()
    {

        $expense = Expense::where('admin_id',$this->idAdmin())->get();

        return $this->returnData('expense', $expense, 'successfully');
    }

    public function mainExpense()
    {

        $expense = Expense::where([['expense_id',null],['admin_id',$this->idAdmin()]])->get();

        return $this->returnData('expense', $expense, 'successfully');
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
                'label'  => 'required|unique:expenses',
                // 'expense_id'  =>  'nullable|exists:expenses,id'

            ]);


            if ($validation->fails())
            {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }

            if($request->expense_id == 0 || $request->expense_id == null){


                $expense = new Expense([
                    'label' => $request->label,
                    'admin_id' => $this->idAdmin(),
                ]);
                $expense->save();

            }else{

                $expense = new Expense([
                    'label' => $request->label,
                    'expense_id' => $request->expense_id,
                    'admin_id' => $this->idAdmin(),
                ]);
                $expense->save();
            }


            return $this->returnData('expense', $expense, 'successfully');

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
        $expense = Expense::where('admin_id',$this->idAdmin())->find($id);
        return $this->returnData('expense',$expense, 'successfully');
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

                'label'  => ['required',Rule::unique('expenses')->ignore($id)],
                'expense_id'  =>  'nullable|exists:expenses,id'
            ]);
            if ($validation->fails())
            {
//                    return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }
            $expense = Expense::where('admin_id',$this->idAdmin())->findOrFail($id);
            $expense->label = $request->label??$expense->label;
            $expense->expense_id = $request->expense_id??$expense->expense_id;
            $expense->admin_id = $this->idAdmin()??$this->idAdmin();
            $expense->update();

            return $this->returnData('expense', $expense, 'successfully');



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
        $expense = Expense::where('admin_id',$this->idAdmin())->findOrFail($id);

        $expense->delete();
        return response()->json("deleted successfully");

    }
}
