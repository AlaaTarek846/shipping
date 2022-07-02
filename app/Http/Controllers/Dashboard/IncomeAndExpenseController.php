<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\IncomeAndExpense;
use App\Models\TransferringTreasury;
use App\Models\Treasury;
use App\Traits\GeneralTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IncomeAndExpenseController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function felltr_income_and_expense(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'treasurie_id' => 'nullable|exists:treasuries,id',
            'payment_date' => 'nullable|date',
        ]);

        if ($validation->fails()) {
            return $this->returnError('errors', $validation->errors());
        }

        if ($request->treasurie_id && $request->payment_date){

            $date = Carbon::parse($request->payment_date);
            $income_and_expense = IncomeAndExpense::with('income','expense','treasury')->
            where('treasurie_id',$request->treasurie_id)->
            whereDate('payment_date',$date)->get();

        }elseif ($request->payment_date){

            $date = Carbon::parse($request->payment_date);

            $income_and_expense = IncomeAndExpense::with('income','expense','treasury')->
            whereDate('payment_date',$date)->get();

        }elseif ($request->treasurie_id ){

            $income_and_expense = IncomeAndExpense::with('income','expense','treasury')->
            where('treasurie_id',$request->treasurie_id)->get();

        }else{

            $income_and_expense = IncomeAndExpense::with('income','expense','treasury')->get();
        }

        return $this->returnData('income_and_expense', $income_and_expense, 'successfully');
    }

    public function index_income($id)
    {
//        return 1556561;
//        $date = [];
//        $index = 0;
        $incomes = IncomeAndExpense::with('income','expense','treasury')->where([
            ['income_id','!=',null],
            ['treasurie_id',$id]])->get();
//        foreach ($incomes as $income)
//        {
//            $date[$index]['price'] = $income->price;
//            $date[$index]['payment_date'] = $income->payment_date;
//            $date[$index]['type_of_payment'] = $income->income->label;
//            $index += 1;
//        }
//        $trans = TransferringTreasury::all();
//        foreach ($trans as $trans)
//        {
//            $date[$index]['price'] = $trans->price;
//            $date[$index]['payment_date'] = $trans->created_at;
//            $date[$index]['type_of_payment'] = $trans->treasury_start->label." تحويل اموال من خزنة ";
//            $index += 1;
//        }



        return $this->returnData('data', $incomes, 'successfully');
    }
    public function index_expense($id)
    {

        $and_expense = IncomeAndExpense::with('income','expense','treasury')->where([['expense_id','!=',null],['treasurie_id',$id]])->get();
//        $date = [];
//        $index = 0;
//        $and_expense = IncomeAndExpense::where([
//            ['expense_id','!=',null],
//            ['treasurie_id',$id]
//        ])->get();
//        foreach ($and_expense as $expense)
//        {
//            $date[$index]['price'] = $expense->price;
//            $date[$index]['payment_date'] = $expense->payment_date;
//            $date[$index]['type_of_payment'] = $expense->expense->label;
//            $index += 1;
//        }
//
//        $trans = TransferringTreasury::all();
//        foreach ($trans as $trans)
//        {
//            $date[$index]['price'] = $trans->price;
//            $date[$index]['payment_date'] = $trans->created_at;
//            $date[$index]['type_of_payment'] = $trans->treasury_start->label." تحويل اموال من خزنة ";
//            $index += 1;
//        }
        return $this->returnData('date', $and_expense, 'successfully');
    }

    public function index()
    {

        $income_and_expense = IncomeAndExpense::with('income','expense')->get();

        return $this->returnData('income_and_expense', $income_and_expense, 'successfully');
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
                'price'  => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'notes'  => 'nullable|string',
                'name'  => 'nullable|string',
                'payment_date'  => 'required|date',
                'user_id'  => 'required|exists:users,id',
                'treasurie_id'  =>  'required|exists:treasuries,id',
                'expense_id'  =>  'nullable|exists:expenses,id',
                'income_id'  =>  'nullable|exists:incomes,id'

            ]);

            if ($validation->fails())
            {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }
            if ($request->expense_id && $request->income_id){

                return response()->json(['error'=>['لا يسمح باختيار الاثنين اختار ايرادات ا ومصروفات']],422);

            }else{

                if ($request->expense_id){
                    $total_amount = Treasury::find($request->treasurie_id);
                    if ($total_amount->amount < $request->price){
                        return response()->json(['error'=>['amount is not enough المبلغ لا يكفي']],422);

                    }
                }

                $income_and_expense = new IncomeAndExpense($request->all());
                $income_and_expense->save();

            }

            return $this->returnData('income_and_expense', $income_and_expense, 'successfully');

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $income_and_expense = IncomeAndExpense::find($id);
        $income_and_expense->destroy($id);
        return response()->json("deleted successfully");
    }
}
