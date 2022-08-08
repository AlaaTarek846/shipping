<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CompanyAccount;
use App\Models\CompanyShipmentDetails;
use App\Models\Shipment;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyAccountController extends Controller
{
    use GeneralTrait;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company_account = CompanyAccount::with('company')->where('admin_id',$this->idAdmin())->get();

        return $this->returnData('company_account', $company_account, 'successfully');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $validation = Validator::make($request->all(), [
                'company_id' => 'required|exists:companies,id',
                'company_accounts.*' => 'required|exists:company_shipment_details,id',
            ]);
            if ($validation->fails()) {
                return $this->returnError('errors', $validation->errors());
            }

            $price = 0;
            $total_company_account = CompanyAccount::create([
                'company_id' => $request->company_id,
                'admin_id' => $this->idAdmin(),

            ]);

            foreach ($request->company_accounts as $company_account) {

                $company_shipment_details = CompanyShipmentDetails::find($company_account);

                if ($company_shipment_details->shipment_status_id == 11) {
                    $price -= $company_shipment_details->shipment_price;
                } else {
                    $price += $company_shipment_details->shipment_price;
                }

                $company_shipment_details->update([
                    'company_account_id' => $total_company_account->id
                ]);
            }
            $total_company_account->update([
                'total_price' => $price
            ]);


            return $this->returnData('company_account', $company_account, 'successfully');

        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company_accounts_details = CompanyShipmentDetails::with('shipmentstatu', 'shipment')->whereNull('company_account_id')->where('company_id', $id)->get();
        return $this->returnData('company_account', $company_accounts_details, 'successfully');

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
