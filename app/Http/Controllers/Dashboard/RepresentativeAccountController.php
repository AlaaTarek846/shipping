<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use App\Traits\ShipmentTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\RepresentativeAccount;
use App\Models\RepresentativeAccountDetail;
use App\Models\ShipmentStatu;
use App\Models\Shipment;
use Illuminate\Support\Facades\DB;


class RepresentativeAccountController extends Controller
{
    use GeneralTrait;
    use ShipmentTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $representative_id = auth()->user()->representative->id;
        $date =[];

        $Representative_commissions = RepresentativeAccount::where('representative_id',$representative_id)->sum('total_commissions');

        $Representative_collection_balance = RepresentativeAccount::where('representative_id',$representative_id)->sum('collection_balance');

        $date['collection_balance'] = $Representative_collection_balance;

        $date['total_commissions'] = $Representative_commissions;


        return $this->returnData('data', $date, 'successfully');

        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'representative_id' => 'required|exists:representatives,id',
            'representative_accounts.*' => 'required|exists:representative_account_details,id',
        ]);
        if ($validation->fails()) {
            return $this->returnError('errors', $validation->errors());
        }

        foreach ($request->representative_accounts as $representative_account) {

            $account_detail = RepresentativeAccountDetail::where([
                ['representative_account_id',"!=", null],
                ['id', $representative_account],
            ])->first();
            if ($account_detail)
            {
              return "mesh htnfa3";
            }

        }

        $total_price = 0;
        $commission = 0;
        $total_representative_account = RepresentativeAccount::create([
            'representative_id' => $request->representative_id
        ]);

        foreach ($request->representative_accounts as $representative_account) {

            $account_detail = RepresentativeAccountDetail::find($representative_account);

            $total_price += $account_detail->collection_balance;

            $commission += $account_detail->commission;


            $account_detail->update([

                'representative_account_id' => $total_representative_account->id
            ]);

        }

        $total_representative_account->update([
            'collection_balance' => $total_price,
            'total_commissions' => $commission,

        ]);


        return $this->returnData('representative_account', $total_representative_account, 'successfully');

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
        DB::beginTransaction();

        try {

            //      =================update validate on Table  Models User and Client
            $representative_id  = auth()->user()->representative->id;

            $shipment = Shipment::where('representative_id',$representative_id)->findOrFail($id);
            $validation = Validator::make($request->all(), [

                'notes' => 'nullable|string',
                'return_price'  =>  'nullable|regex:/^\d+(\.\d{1,2})?$/',
                'shipment_status_id'  =>  'required|exists:shipment_status,id',
                'reason_id' => 'nullable|exists:reasons,id',

            ]);
            if ($validation->fails()) {
                return $this->returnError('errors', $validation->errors());
            }

            $shipment->notes = $request->notes??$shipment->notes;
            $shipment->return_price = $request->return_price??$shipment->return_price;
            $shipment->reason_id = $request->reason_id;
            $shipment->shipment_status_id = $request->shipment_status_id??$shipment->shipment_status_id;

            $shipment->update();

            if($shipment->shipment_status_id == 3) {

                $store_id = $shipment->store_id;
                $representative_id = $shipment->representative_id;
                if (!$this->calculateStatus3($shipment, $store_id, $representative_id)) {
                    return 0;
                }
            }elseif($shipment->shipment_status_id == 4) {

                $store_id = $shipment->store_id;
                $representative_id = $shipment->representative_id;
                if (!$this->calculateStatus4($shipment, $store_id, $representative_id)) {
                    return 0;
                }
            }elseif ($shipment->shipment_status_id == 7) {
                $store_id = $shipment->store_id;
                $representative_id = $shipment->representative_id;
                if (!$this->calculateStatus7($shipment, $store_id, $representative_id)) {
                    return 0;
                }
            } elseif ($shipment->shipment_status_id == 8) {
                $return_price = $shipment->return_price;
                $store_id = $shipment->store_id;
                $representative_id = $shipment->representative_id;
                if (!$this->calculateStatus8($shipment, $return_price, $store_id, $representative_id)) {
                    return 0;
                }
            } elseif ($shipment->shipment_status_id == 9) {

                $return_price = $shipment->return_price;
                $store_id = $shipment->store_id;
                $representative_id = $shipment->representative_id;
                if (!$this->calculateStatus9($shipment, $return_price, $store_id, $representative_id)) {
                    return 0;
                }

            } elseif ($shipment->shipment_status_id == 10) {
                $store_id = $shipment->store_id;
                $representative_id = $shipment->representative_id;
                if (!$this->calculateStatus10($shipment, $store_id, $representative_id)) {
                    return 0;
                }
            } elseif ($shipment->shipment_status_id == 11) {
                $store_id = $shipment->store_id;
                $representative_id = $shipment->representative_id;
                if (!$this->calculateStatus11($shipment, $store_id, $representative_id)) {
                    return 0;
                }
            }


            DB::commit();
            //        return response()->json($admin);
            return $this->returnData('shipment', $shipment, 'successfully');

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }
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
