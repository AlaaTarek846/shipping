<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\PaymentType;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PaymentTypeController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment_type  = PaymentType::all();

        return $this->returnData('payment_type', $payment_type, 'successfully');
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
                'type'  =>  'required|unique:payment_types',
                'description'  =>  'required|string',
            ]);
            if ($validation->fails())
            {
                return $this->returnError('errors', $validation->errors());
            }
            $payment_type = new PaymentType($request->all());
            $payment_type->save();
            return $this->returnData('payment_type', $payment_type, 'successfully');

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
        $payment_type = PaymentType::findOrFail($id);
        return $payment_type;
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
                'type'  =>  ['required', Rule::unique('payment_types')->ignore($id)],
                'description'  =>  'required|string',
            ]);
            if ($validation->fails())
            {
                return $this->returnError('errors', $validation->errors());
            }
            $payment_type = PaymentType::findOrFail($id);
            $payment_type->update($request->all());

            return $this->returnData('payment_type', $payment_type, 'successfully');

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
        $payment_type = PaymentType::findOrFail($id);

        if (count($payment_type->company) > 0)
        {

            return response()->json("no delete",400);
        }else{

        $payment_type->delete();
        return response()->json("deleted successfully");
        }
    }
}
