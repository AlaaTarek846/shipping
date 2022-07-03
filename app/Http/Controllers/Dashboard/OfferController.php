<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class OfferController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $offer  = Offer::where('admin_id',$this->idAdmin())->with('company','admin')->get();

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
        try {

            $validation =Validator::make($request->all(),[
                'title'  =>  'required|unique:offers',
            ]);
            if ($validation->fails())
            {
                return $this->returnError('errors', $validation->errors());
            }
            $offer = new Offer([
                'title' => $request->title,
                'admin_id' => $this->idAdmin(),

            ]);
            $offer->save();
            return $this->returnData('offer', $offer, 'successfully');

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
        $offer = Offer::where('admin_id',$this->idAdmin())->findOrFail($id);
        return $offer;
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
                'title'  =>  ['required', Rule::unique('offers')->ignore($id)],

            ]);
            if ($validation->fails())
            {
                return $this->returnError('errors', $validation->errors());
            }
            $offer = Offer::where('admin_id',$this->idAdmin())->findOrFail($id);
            $offer->title = $request->title??$storage_system->title;
            $offer->admin_id = $this->idAdmin()??$this->idAdmin();
            $offer->update();

            return $this->returnData('offer', $offer, 'successfully');

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
        $offer = Offer::findOrFail($id);

        if (count($offer->provinces) > 0)
        {
            return response()->json("no delete",400);

        }else{

            $offer->delete();
            return response()->json("deleted successfully");
        }
    }
}
