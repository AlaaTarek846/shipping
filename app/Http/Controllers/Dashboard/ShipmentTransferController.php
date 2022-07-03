<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Traits\GeneralTrait;
use App\Traits\ShipmentTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\ShipmentTransfer;

class ShipmentTransferController extends Controller
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
        $shipment_transfer  = ShipmentTransfer::latest()->paginate(15);

        return $this->returnData('shipment_transfer', $shipment_transfer, 'successfully');
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
                'data_transfer' => 'required|array',
                'data_transfer.*.store_start_id' => 'sometimes|required|exists:stores,id',
                'data_transfer.*.shipment_id' => 'sometimes|required|exists:shipments,id',
                'data_transfer.*.representative_id' => 'sometimes|required|exists:representatives,id',
                'data_transfer.*.employee_id' => 'sometimes|required|exists:employees,id',
                'data_transfer.*.store_end_id' => 'sometimes|required|exists:stores,id',
            ]);

            if ($validation->fails())
            {
                return response()->json($validation->errors(), 422);
            }

            foreach ($request->data_transfer as $data_transfer){

                $shipment_transfer = ShipmentTransfer::create([
                    'store_start_id' => $data_transfer['store_start_id']??null,
                    'shipment_id' => $data_transfer['shipment_id']??null,
                    'representative_id' => $data_transfer['representative_id']??null,
                    'employee_id' => $data_transfer['employee_id']??null,
                    'store_end_id' => $data_transfer['store_end_id']??null,
                    'notes' => $data_transfer['notes']??null,
                    'notes' => $data_transfer['notes']??null,
                ]);
            }

            return response()->json("successfully");

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
        $shipment_transfer = ShipmentTransfer::findOrFail($id);
        return $shipment_transfer;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $validation =Validator::make($request->all(),[
                'data_transfer' => 'required|array',
                'data_transfer.*.store_start_id' => 'sometimes|required|exists:stores,id',
                'data_transfer.*.shipment_id' => 'sometimes|required|exists:shipments,id',
                'data_transfer.*.representative_id' => 'sometimes|required|exists:representatives,id',
                'data_transfer.*.employee_id' => 'sometimes|required|exists:employees,id',
                'data_transfer.*.store_end_id' => 'sometimes|required|exists:stores,id',
                'data_transfer.*.notes' => 'nullable|string',
            ]);
            if ($validation->fails())
            {
                return $this->returnError('errors', $validation->errors());
            }

            foreach ($request->data_transfer as $data_transfer ){

                $shipment_transfer = ShipmentTransfer::findOrFail($data_transfer['id']);

                $shipment_transfer->update([

                    'store_start_id' => $data_transfer['store_start_id']??$shipment_transfer->store_start_id,
                    'shipment_id' => $data_transfer['shipment_id']??$shipment_transfer->shipment_id,
                    'representative_id' => $data_transfer['representative_id']??$shipment_transfer->representative_id,
                    'employee_id' => $data_transfer['employee_id']??$shipment_transfer->employee_id,
                    'storestatus_end_id' => $data_transfer['store_end_id']??$shipment_transfer->store_end_id,
                    'status' => $data_transfer['status']??$shipment_transfer->status,
                    'notes' => $data_transfer['notes']??$shipment_transfer->notes,
                ]);

            }

            return response()->json("successfully");

//            return $this->returnData('shipment_transfer', $shipment_transfer, 'successfully');

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
        $shipment_transfer = ShipmentTransfer::findOrFail($id);

//        if ($shipment_transfer->shipment && $shipment_transfer->employee && $shipment_transfer->representative && $shipment_transfer->store_start && $shipment_transfer->store_end )

            $shipment_transfer->delete();

            return response()->json("deleted successfully");

    }
}
