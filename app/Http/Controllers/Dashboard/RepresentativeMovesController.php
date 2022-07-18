<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\RepresentativeMove;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RepresentativeMovesController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $representative_move = RepresentativeMove::where('admin_id',$this->idAdmin())->with('Representative')->latest()->paginate('20');
        return $this->returnData('representative_move', $representative_move, 'successfully');

    }

    public function all_representative_moves()
    {
        $representative_id =  auth()->user()->representative->id;

        $representative_move = RepresentativeMove::with('Representative')->where([['representative_id',$representative_id],['admin_id',$this->idAdmin()]])->latest()->paginate('20');
        return $this->returnData('representative_move', $representative_move, 'successfully');

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

                'date'  => 'required|date',
                'time'  =>  'required',
                'google_location'  =>  'required|string',
                'area'  =>  'required|string',
                'representative_id'  =>  'required|exists:representatives,id',

            ]);
            if ($validation->fails())
            {
                return $this->returnError('errors', $validation->errors());
            }

            $representative_move = RepresentativeMove::create([

                'date' => $request->date,
                'time' => $request->time,
                'area' => $request->area,
                'google_location' => $request->google_location,
                'representative_id' => $request->representative_id,
                'admin_id' => $this->idAdmin(),

            ]);

            return $this->returnData('representative_move', $representative_move, 'successfully');

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

                'date'  => 'required|date',
                'time'  =>  'required',
                'google_location'  =>  'required|string',
                'area'  =>  'required|string',
                'representative_id'  =>  'required|exists:representatives,id',

            ]);
            if ($validation->fails())
            {
                return $this->returnError('errors', $validation->errors());
            }
            $representative_move = RepresentativeMove::where('admin_id',$this->idAdmin())->findOrFail($id);

            $representative_move->date = $request->date;
            $representative_move->time = $request->time;
            $representative_move->google_location = $request->google_location;
            $representative_move->area = $request->area;
            $representative_move->representative_id = $request->representative_id;
            $representative_move->admin_id = $this->idAdmin()??$this->idAdmin();


            $representative_move->update();

            return $this->returnData('representative_move', $representative_move, 'successfully');

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
        $representative_move = RepresentativeMove::where('admin_id',$this->idAdmin())->findOrFail($id);

        $representative_move->delete();
        return response()->json("deleted successfully");
    }
}
