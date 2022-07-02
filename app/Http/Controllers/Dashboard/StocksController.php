<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StocksController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stock = Stock::with('company','store')->get();
        return $this->returnData('stock', $stock, 'successfully');

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

                'unit_price'  => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'name_product'  => 'required|string',
                'count'  =>  'required|integer',
                'store_id'  =>  'nullable|exists:stores,id',
                'company_id'  =>  'required|exists:companies,id',

            ]);
            if ($validation->fails())
            {
                return $this->returnError('errors', $validation->errors());
            }

            $stock = Stock::create([

                'unit_price' => $request->unit_price,
                'name_product' => $request->name_product,
                'count' => $request->count,
                'store_id' => $request->store_id,
                'company_id' => $request->company_id,

            ]);

            return $this->returnData('stock', $stock, 'successfully');

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

                'unit_price'  => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'name_product'  => 'required|string',
                'count'  =>  'required|integer',
                'store_id'  =>  'nullable|exists:stores,id',
                'company_id'  =>  'required|exists:companies,id',

            ]);
            if ($validation->fails())
            {
                return $this->returnError('errors', $validation->errors());
            }
            $stock = Stock::findOrFail($id);

            $stock->unit_price = $request->unit_price;
            $stock->name_product = $request->name_product;
            $stock->count = $request->count;
            $stock->store_id = $request->store_id;
            $stock->company_id = $request->company_id;

            $stock->update();

            return $this->returnData('stock', $stock, 'successfully');

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
        $stock = Stock::findOrFail($id);
        if (count($stock->stock_detail) > 0  ){

            return response()->json("no deleted ");

        }else{

            $stock->delete();
            return response()->json("deleted successfully");

        }


    }
}
