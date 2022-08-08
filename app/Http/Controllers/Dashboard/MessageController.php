<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MessageController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::where('admin_id',$this->idAdmin())->get();

        return $this->returnData('messages', $messages, 'successfully');

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
                'text'=> 'required|unique:messages',
            ]);
            if ($validation->fails())
            {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }
            $messages = new Message([

                'text' => $request->text,
                'admin_id' => $this->idAdmin(),

            ]);
            $messages->save();
            return $this->returnData('messages', $messages, 'successfully');

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
        $job = Job::findOrFail($id);
        return $job;
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
                'text'=> ['required', Rule::unique('messages','text')->ignore($id)],
            ]);
            if ($validation->fails())
            {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }
            $messages = Message::where('admin_id',$this->idAdmin())->findOrFail($id);
            $messages->text = $request->text??$messages->text;
            $messages->admin_id = $this->idAdmin()??$this->idAdmin();
            $messages->update();

            return $this->returnData('messages', $messages, 'successfully');
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
        $messages = Message::where('admin_id',$this->idAdmin())->findOrFail($id);


        $messages->delete();
            return response()->json("deleted successfully");
    }
}
