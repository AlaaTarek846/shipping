<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MessageRepresentative;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MessageRepresentativeController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $message_representative = MessageRepresentative::with('Representative')->get();

        return $this->returnData('message_representative', $message_representative, 'successfully');
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
                'title'  => 'nullable|string',
                'photo'  => 'mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf|nullable',
                'representative_id'  =>  'required|exists:representatives,id'

            ]);
            if ($validation->fails())
            {
                return $this->returnError('errors', $validation->errors());

            }

            $message_representative = new MessageRepresentative($request->all());
            if ($request->hasFile('photo')) {
                $file = $request->photo;
                $new_file = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/message_representative', $new_file);
                $message_representative->photo=$new_file;

            }else{
                $new_file = null;
            }
            $message_representative->save();
            $message_representative->Representative;
            return $this->returnData('message_representative', $message_representative, 'successfully');

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

                'title'  => 'nullable|string',
                'photo'  => 'mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf|nullable',
                'representative_id'  =>  'required|exists:representatives,id'

            ]);
            if ($validation->fails())
            {
                return $this->returnError('errors', $validation->errors());

            }
            $message_representative = MessageRepresentative::findOrFail($id);
            $name = $message_representative->photo;

            $message_representative->update($request->all());

            if ($request->hasFile('photo')) {
                if ($name !== null) {
                    unlink(public_path('/uploads/message_representative/') . $name);
                }
                $file = $request->photo;
                $new_file = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/message_representative', $new_file);
                $message_representative->photo = $new_file;
            }
            $message_representative->Representative;

            return $this->returnData('message_representative', $message_representative, 'successfully');



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
        $message_representative = MessageRepresentative::findOrFail($id);

        $message_representative->delete();
        return response()->json("deleted successfully");

    }
}
