<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\RepresentativeAccountDetail;
use App\Models\RepresentativeAccount;

class RepresentativeShipmentController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Representative_Account_Detail(){

        $data = [];

        $total_collection_balance =  RepresentativeAccountDetail::whereDate('created_at', now()->format('Y-m-d'))->sum('collection_balance');

        $total_commission =  RepresentativeAccountDetail::whereDate('created_at', now()->format('Y-m-d'))->sum('commission');

        $total = $total_collection_balance + $total_commission;

        /* 1*/
        $data['$total_collection_balance'] = $total_collection_balance;
        /* 2*/
        $data['$total_commission'] = $total_commission;
        /* 3*/
        $data['$total'] = $total;


        return $this->returnData('data', $data, 'successfully');
    }

    public function Filter_Representative_Account_Detail(Request $request){

        $data = [];
        $start = Carbon::parse($request->date);

        $total_collection_balance =  RepresentativeAccountDetail::whereDate('created_at', $start->format('Y-m-d'))->sum('collection_balance');

        $total_commission =  RepresentativeAccountDetail::whereDate('created_at', $start->format('Y-m-d'))->sum('commission');

        $total = $total_collection_balance + $total_commission;

        /* 1*/
        $data['$total_collection_balance'] = $total_collection_balance;
        /* 2*/
        $data['$total_commission'] = $total_commission;
        /* 3*/
        $data['$total'] = $total;


        return $this->returnData('data', $data, 'successfully');
    }

    public function index($id)
    {

        $representative_account = RepresentativeAccountDetail::with('representative', 'representative_account', 'shipment', 'shipmentstatu')->
        where([
            ['representative_id', $id],
            ['representative_account_id', null]
        ])->get();
        return $this->returnData('representative_account', $representative_account, 'successfully');

    }

    public function index_account($id)
    {
        $account_detail = RepresentativeAccountDetail::with('representative', 'representative_account', 'shipment', 'shipmentstatu')->
        where([
            ['representative_id', $id],
            ['representative_account_id', '!=', null]
        ])->get();

        return $this->returnData('account_detail', $account_detail, 'successfully');

    }

    public function Total_account($id)
    {
        $Total_account = RepresentativeAccount::with('representative_account_detail')->
        where('representative_id', $id,)->get();

        return $this->returnData('Total_account', $Total_account, 'successfully');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
