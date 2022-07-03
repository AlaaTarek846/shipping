<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::where('admin_id',$this->idAdmin())->with('admin')->get();

        return $this->returnData('jobs', $jobs, 'successfully');

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
                'name'=> 'required|unique:jobs',
            ]);
            if ($validation->fails())
            {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }
//            $arr=explode(',',$request->name);

            $job = new Job([
                'name' => $request->name,
                'admin_id' => $this->idAdmin(),

            ]);

            $job->save();
            return $this->returnData('job', $job, 'successfully');

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
        $job = Job::where('admin_id',$this->idAdmin())->with('admin')->findOrFail($id);
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
//            $arr=explode(',',$name);
            $validation =Validator::make($request->all(),[
                'name'=> ['required', Rule::unique('jobs','name')->ignore($id)],
            ]);
            if ($validation->fails())
            {
//                return response()->json($validation->errors(), 422);
                return $this->returnError('errors', $validation->errors());

            }
            $job = Job::where('admin_id',$this->idAdmin())->findOrFail($id);
            $job->name = $request->name??$job->name;
            $job->admin_id = $this->idAdmin()??$this->idAdmin();
            $job->update();

            return $this->returnData('job', $job, 'successfully');
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
        $job= Job::where('admin_id',$this->idAdmin())->findOrFail($id);

        if (count($job->employees) > 0)
        {
            return response()->json("no delete",400);
        }else{
            $job->delete();
            return response()->json("deleted successfully");
        }
    }
}
