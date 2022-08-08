<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\RepresentativeExpense;
use App\Models\RepresentativeIncome;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class RepresentativeExpenseController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index_filter(Request $request)
    {
        $date = [];
        $start = Carbon::parse($request->start_date)->format('Y-m-d');
        $end = Carbon::parse($request->end_date)->format('Y-m-d');

        $representative_expense = RepresentativeExpense::where('admin_id',$this->idAdmin())->with('treasury')->whereDate('created_at','<=',$end)
            ->whereDate('created_at','>=',$start)->get();
        $representative_income = RepresentativeIncome::with('representative','shipment')->whereDate('created_at','<=',$end)
            ->whereDate('created_at','>=',$start)->where('admin_id',$this->idAdmin())->get();

        /* 1*/
        $data['representative_expense'] = $representative_expense;
        /* 2*/
        $data['representative_income'] = $representative_income;

        $data['total_expense'] = $representative_expense->sum('amount');
        $data['total_income'] = $representative_income->sum('amount');
        $data['total_amount'] = $representative_income->sum('amount') - $representative_expense->sum('amount');

        return $this->returnData('data', $data, 'successfully');
    }

//    public function index()
//    {
//        //
//    }

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
                'amount'  => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'notes'  => 'nullable|string',
                'treasurie_id'  =>  'nullable|exists:treasuries,id'

            ]);

            if ($validation->fails())
            {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }

            $representative_expense = new RepresentativeExpense([

                'amount' => $request->amount,
                'notes' => $request->notes,
                'treasurie_id' => $request->treasurie_id,
                'admin_id' => $this->idAdmin(),

            ]);
            $representative_expense->save();


            return $this->returnData('representative_expense', $representative_expense, 'successfully');

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
        try {

            $validation =Validator::make($request->all(),[
                'amount'  => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'notes'  => 'nullable|string',
                'treasurie_id'  =>  'nullable|exists:treasuries,id'
            ]);
            if ($validation->fails())
            {
//                    return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }
            $representative_expense = RepresentativeExpense::where('admin_id',$this->idAdmin())->findOrFail($id);
            $representative_expense->amount = $request->amount??$representative_expense->amount;
            $representative_expense->notes = $request->notes??$representative_expense->notes;
            $representative_expense->treasurie_id = $request->treasurie_id??$representative_expense->treasurie_id;
            $representative_expense->admin_id = $this->idAdmin()??$this->idAdmin();
            $representative_expense->update();

            return $this->returnData('representative_expense', $representative_expense, 'successfully');



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
        $representative_expense = RepresentativeExpense::where('admin_id',$this->idAdmin())->findOrFail($id);

        $representative_expense->delete();
        return response()->json("deleted successfully");    }
}
