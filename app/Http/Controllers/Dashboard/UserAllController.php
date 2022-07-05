<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class UserAllController extends Controller
{
    use GeneralTrait;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function active_user($id)
    {
        $user = User::where('admin_id',$this->idAdmin())->findOrFail($id);
        $user->update([
            'is_active' => 1
        ]);
        return $this->returnData('user', $user, 'successfully');

    }

    public function no_active_user($id)
    {
        $user = User::where('admin_id',$this->idAdmin())->findOrFail($id);
        $user->update([
            'is_active' => 0
        ]);
        return $this->returnData('user', $user, 'successfully');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function alluser()
    {
        $user = User::where('admin_id',$this->idAdmin())->latest()->paginate(15);
        return $this->returnData('user', $user, 'successfully');

    }
    public function all_user_active()
    {
        $user = User::where([['is_active',1],['admin_id',$this->idAdmin()]])->latest()->paginate(15);
        return $this->returnData('user', $user, 'successfully');

    }

    public function all_user_no_active()
    {
        $user = User::where([['is_active',0],['admin_id',$this->idAdmin()]])->latest()->paginate(15);
        return $this->returnData('user', $user, 'successfully');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function all_user_company()
    {
        $user = User::where([['is_active',1],['user_type','company'],['admin_id',$this->idAdmin()]])->orWhere('user_type','admin')->get();

        return $this->returnData('user', $user, 'successfully');
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
        //
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
}
