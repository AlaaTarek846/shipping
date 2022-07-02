<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::where('admin_id',$this->idAdmin())->with('admin')->get();

        return $this->returnData('departments', $departments, 'successfully');
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
                'name'  => 'required|unique:departments',
            ]);
            if ($validation->fails())
            {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }
            $department = new Department([
                'name' => $request->name,
                'admin_id' => $this->idAdmin(),

            ]);
            $department->save();
            return $this->returnData('department', $department, 'successfully');

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
        $department = Department::where('admin_id',$this->idAdmin())->findOrFail($id);
        return $department;
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
                'name'  => ['required',Rule::unique('departments','name')->ignore($id)],
            ]);
            if ($validation->fails())
            {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }
            $department = Department::findOrFail($id);
            $department->update($request->all());
            return $this->returnData('department', $department, 'successfully');

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
        $department = Department::findOrFail($id);

        if (count($department->employees) > 0)
        {
            return response()->json("no delete",400);
        }else{
            $department->delete();
            return response()->json("deleted successfully");
        }
    }

    public function active($id)
    {
        $department = Department::findOrFail($id);
        $department->user->update([
            'is_active' =>  1
        ]);
        return 'Activated';
    }



    public function deActive($id)
    {
        $department = Department::findOrFail($id);
        $department->user->update([
            'is_active' =>  0
        ]);
        return  'DeActivated';
    }
}
