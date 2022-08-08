<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\StorageSystem;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StorageSystemController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $storage_system  = StorageSystem::where('admin_id',$this->idAdmin())->with('company','admin')->get();

        return $this->returnData('storage_system', $storage_system, 'successfully');
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
                'title'  =>  'required|unique:storage_systems',
                'description'  =>  'required|string',
            ]);
            if ($validation->fails())
            {
                return $this->returnError('errors', $validation->errors());
            }
            $storage_system = new StorageSystem([
                'title' => $request->title,
                'description' => $request->description,
                'admin_id' => $this->idAdmin(),

            ]);
            $storage_system->save();
            return $this->returnData('storage_system', $storage_system, 'successfully');

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
        $storage_system = StorageSystem::where('admin_id',$this->idAdmin())->findOrFail($id);
        return $storage_system;
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
                'title'  =>  ['required', Rule::unique('storage_systems')->ignore($id)],
                'description'  =>  'required|string',

            ]);
            if ($validation->fails())
            {
                return $this->returnError('errors', $validation->errors());
            }
            $storage_system = StorageSystem::where('admin_id',$this->idAdmin())->findOrFail($id);
            $storage_system->title = $request->title??$storage_system->title;
            $storage_system->description = $request->description??$storage_system->description;
            $storage_system->admin_id = $this->idAdmin()??$this->idAdmin();
            $storage_system->update();


            return $this->returnData('storage_system', $storage_system, 'successfully');

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
        $storage_system = StorageSystem::where('admin_id',$this->idAdmin())->findOrFail($id);

//        if (count($storage_system->provinces) > 0)
//        {
//            return response()->json("no delete",400);
//
//        }else{

            $storage_system->delete();
            return response()->json("deleted successfully");
//        }
    }
}
