<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CompanyShipmentDetails;
use App\Models\CompanyAccount;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyShipmentDetailsController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company_account_detail = CompanyShipmentDetails::where('admin_id',$this->idAdmin())->with('company')->latest()->paginate('20');
        return $this->returnData('company_account_detail', $company_account_detail, 'successfully');

    }

    public function all_Company_Shipment_Detail()
    {
        $company_id =  auth()->user()->company->id;

        $company_shipment_detail = CompanyShipmentDetails::where([['company_id',$company_id],['admin_id',$this->idAdmin()]])->latest()->paginate('20');
        return $this->returnData('company_shipment_detail', $company_shipment_detail, 'successfully');

    }

    public function index_detail($id)
    {
        $company_detail = CompanyShipmentDetails::with('company','shipmentstatu','company_account','shipment')
            ->where([['company_id',$id],['company_account_id',null],['admin_id',$this->idAdmin()]])->get();
        return $this->returnData('company_detail', $company_detail, 'successfully');
    }
    public function index_account($id)
    {

        $account_detail = CompanyShipmentDetails::with('company','shipmentstatu','company_account','shipment')->
        where([['company_id',$id],['company_account_id','!=',null],['admin_id',$this->idAdmin()]])->get();
        return $this->returnData('account_detail', $account_detail, 'successfully');

    }

    public function total_account($id)
    {
        $total_account = CompanyAccount::with('company_shipment_details')->where([['company_id',$id],['admin_id',$this->idAdmin()]])->get();
        return $this->returnData('total_account', $total_account, 'successfully');

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

                'shipment_price'  => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'company_id'  =>  'required|exists:companies,id',
                'shipment_id'  =>  'required|exists:companies,id',
                'company_account_id'  =>  'nullable|exists:companies,id',

            ]);
            if ($validation->fails())
            {
                return $this->returnError('errors', $validation->errors());
            }

            $company_shipment_detail = CompanyShipmentDetails::create([

                'shipment_price' => $request->shipment_price,
                'company_id' => $request->company_id,
                'shipment_id' => $request->shipment_id,
                'company_account_id' => $request->company_account_id,
                'admin_id' => $this->idAdmin(),



            ]);

            return $this->returnData('company_shipment_detail', $company_shipment_detail, 'successfully');

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

                'shipment_price'  => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'company_id'  =>  'required|exists:companies,id',
                'shipment_id'  =>  'required|exists:companies,id',
                'company_account_id'  =>  'nullable|exists:companies,id',

            ]);
            if ($validation->fails())
            {
                return $this->returnError('errors', $validation->errors());
            }
            $company_shipment_detail = CompanyShipmentDetails::where('admin_id',$this->idAdmin())->findOrFail($id);

            $company_shipment_detail->shipment_price = $request->shipment_price;
            $company_shipment_detail->company_id = $request->company_id;
            $company_shipment_detail->shipment_id = $request->shipment_id;
            $company_shipment_detail->company_account_id = $request->company_account_id;
            $company_shipment_detail->admin_id = $this->idAdmin()??$this->idAdmin();

            $company_shipment_detail->update();

            return $this->returnData('company_shipment_detail', $company_shipment_detail, 'successfully');

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
        $company_shipment_detail = CompanyShipmentDetails::where('admin_id',$this->idAdmin())->findOrFail($id);

        $company_shipment_detail->delete();
        return response()->json("deleted successfully");
    }
}
