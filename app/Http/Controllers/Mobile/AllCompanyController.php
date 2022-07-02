<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\CompanyShipmentDetails;
use App\Models\Shipment;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class AllCompanyController extends Controller
{
    use GeneralTrait;

    public function all_company_account()
    {
        $company_id = auth()->user()->company->id;

        $data = [];
        $company_accounts = CompanyShipmentDetails::where([
            ['company_id' , $company_id],
            ['company_account_id' , null],
        ])->get();

        $price = 0;
        foreach ($company_accounts as $company_account) {
            if ($company_account->shipment_status_id == 11) {
                $price -= $company_account->shipment_price;
            } else {
                $price += $company_account->shipment_price;
            }

        }

        $company_id = auth()->user()->id;
        $shipment = Shipment::where([
            ['sender_id' , $company_id],
            ['shipment_status_id' , 1 ],
        ])->orWhere([
            ['sender_id' , $company_id],
            ['shipment_status_id' , 2 ],
        ])->orWhere([
            ['sender_id' , $company_id],
            ['shipment_status_id' , 3 ],
        ])->orWhere([
            ['sender_id' , $company_id],
            ['shipment_status_id' , 4 ],
        ])->orWhere([
            ['sender_id' , $company_id],
            ['shipment_status_id' , 5 ],
        ])->orWhere([
            ['sender_id' , $company_id],
            ['shipment_status_id' , 6 ],
        ])->orWhere([
            ['sender_id' , $company_id],
            ['shipment_status_id' , 12 ],
        ])->sum('product_price');

        $data['balance_due'] = $price;
        $data['cod'] = $shipment;

        return $this->returnData('company_account', $data, 'successfully');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

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
