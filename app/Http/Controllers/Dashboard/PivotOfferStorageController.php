<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\OfferCompany;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\StorageSystem;
use App\Models\Offer;
use App\Models\Company;
use Illuminate\Support\Facades\Validator;


class PivotOfferStorageController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_storage_system_company()
    {
        $company = auth()->user()->company;

        $storage_system = StorageSystem::with(['company'=> function ($q) use ($company) {
            $q->where('storage_system_companies.company_id',  $company->id );
        }])->get();
        return $this->returnData('storage_system', $storage_system, 'successfully');

    }
    public function index_offer_company()
    {
        $company = auth()->user()->company;
        $offer = Offer::with(['company'=> function ($q) use ($company) {
            $q->where('companies.id',  $company->id );
        }])->get();
        return $this->returnData('offer', $offer, 'successfully');

    }
    public function index_storage_system()
    {
        $storage_system = StorageSystem::with('company')->get();
        return $this->returnData('storage_system', $storage_system, 'successfully');
    }

    public function index_offer()
    {
        $offer = Offer::with('company')->get();
        return $this->returnData('offer', $offer, 'successfully');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//return $request;
        try {
            //      =================validate on Table  Models User and Client

            $validation = Validator::make($request->all(), [

                'storage_system.*'  =>  'nullable|exists:storage_systems,id',

            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }


            $company = auth()->user()->company;


            $company->storage_system()->syncWithoutDetaching($request->storage_system);

            $company->storage_system;

            return $this->returnData('company', $company, 'successfully');

        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    //get offer company
    public function getStoragesystem(){
        $company = auth()->user()->company;

        return $this->returnData('storage_system', $company->storage_system, 'successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeoffer(Request $request)
    {

        try {

            $validation = Validator::make($request->all(), [

                'offer.*'  =>  'nullable|exists:offers,id',

            ]);
            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }

            $company = auth()->user()->company;

            $company->offer()->syncWithoutDetaching($request->offer);

            $company->Offer;

            return $this->returnData('company', $company, 'successfully');

        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    //get offer company
    public function getOfferCompany(){
        $company = auth()->user()->company;

        return $this->returnData('offers', $company->Offer, 'successfully');
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
