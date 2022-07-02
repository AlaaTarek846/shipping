<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\RepresentativeIncome;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class RepresentativeIncomeController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_representative_income_all()
    {
        $representative_income =   RepresentativeIncome::with('representative','shipment')->whereDate('')->sum('amount');
        return $this->returnData('representative_income', $representative_income, 'successfully');



    }

//    public function fillter_representative_income_all()
//    {
//        $representative_income =   RepresentativeIncome::with('representative','shipment')->get();
//        return $this->returnData('representative_income', $representative_income, 'successfully');
//
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
