<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ContactMessageController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact_message = ContactMessage::all();

        return $this->returnData('contact_message', $contact_message, 'successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            //      =================validate on Table  Models Branch

            $validation = Validator::make($request->all(), [
                'name' => 'required|unique:branches',
                'phone' => 'nullable|min:11',
                'email' => 'required|email',
                'messages' => 'required|nullable',
            ]);
            if ($validation->fails()) {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }

            $contact_message = new ContactMessage($request->all());
            $contact_message->save();
            return $this->returnData('contact_message', $contact_message, 'successfully');

        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $branch = Branch::findOrFail($id);
//        return $this->returnData('branch', $branch, 'successfully');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        try {
//            $validation = Validator::make($request->all(), [
//
//                'name' => ['required', Rule::unique('branches')->ignore($id)],
//                'address' => 'required',
//                'phone' => 'required|min:11|unique:branches,phone' . ($id ? ",$id" : ''),
//                'email' => 'nullable|regex:/(.+)@(.+)\.(.+)/i',
//                'location' => 'string|nullable',
//                'photo' => 'mimes:jpeg:jpeg,jpg,png,gif|nullable',
//                'area_id'  =>  'required|exists:areas,id',
//            ]);
//            if ($validation->fails()) {
////                return response()->json($validation->errors(), 422);
//                return $this->returnError('errors', $validation->errors());
//
//            }
//
//            $branch = Branch::findOrFail($id);
//
//            $name = $branch->photo;
//
//            $branch->update($request->all());
//
//            //      =================update  photo  App\Models\Branch
//
//            $branch ->update($request->all());
//            if ($request->hasFile('photo')) {
//                if ($name !== null) {
//                    unlink(public_path('/uploads/branch/') . $name);
//                }
//                $file = $request->photo;
//                $new_file = time() . $file->getClientOriginalName();
//                $file->move(public_path() . '/uploads/branch', $new_file);
//                $branch->photo = $new_file;
//            }
//            $branch->update();
//            return $this->returnData('branch', $branch, 'successfully');
//
//        } catch (\Exception $e) {
//
//            return response()->json(['error' => $e->getMessage()], 500);
//        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact_message = ContactMessage::find($id);
        $contact_message->destroy($id);
        return response()->json("deleted successfully");


    }
}
