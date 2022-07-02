<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Complain;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplainController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id =  auth()->user()->id;

        $complain = Complain::with('user')->where('user_id',$user_id)->get();

        return $this->returnData('complain', $complain, 'successfully');
    }

    public function allStatusNoactive()
    {

        $complain = Complain::with('user')->where('status',0)->get();

        return $this->returnData('complain', $complain, 'successfully');
    }

    public function allStatus()
    {

        $complain = Complain::with('user')->get();

        return $this->returnData('complain', $complain, 'successfully');
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

                'notes'  => 'required|string',

            ]);
            if ($validation->fails())
            {
                return $this->returnError('errors', $validation->errors());
            }

            $user_id =  auth()->user()->id;
            $complain = Complain::create([

                'user_id' => $user_id,
                'notes' => $request->notes,

            ]);


            return $this->returnData('complain', $complain, 'successfully');

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

                'notes'  => 'required|string',

            ]);
            if ($validation->fails())
            {
                return $this->returnError('errors', $validation->errors());
            }
            $complain = Complain::findOrFail($id);

            $user_id =  auth()->user()->id;
            $complain->user_id = $user_id;

            $complain->notes = $request->notes;

            $complain->update();

            return $this->returnData('complain', $complain, 'successfully');

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
//

    }

    public function status_active($id)
    {
        $complain = Complain::findOrFail($id);
        $complain->update([
            'status' => 1
        ]);
        return $this->returnData('complain', $complain, 'successfully');

    }

    public function all_complain_active()
    {

        $user_id =  auth()->user()->id;

        $complain = Complain::with('user')->where([['user_id',$user_id],['status',1]])->get();

        return $this->returnData('complain', $complain, 'successfully');

    }




}
