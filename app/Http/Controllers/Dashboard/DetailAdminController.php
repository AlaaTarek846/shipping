<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageUser;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class DetailAdminController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allAdminNewDay()
    {
        //    - جدول يحتول على بيانات كافة المشتركين الجديد فى نفس اليوم

        $admin = User::whereDate('created_at',now()->format('Y-m-d'))->where('user_type','admin')->get();
        return $this->returnData('admin', $admin, 'successfully');

    }

    public function allCountPackage()
    {
        //    - عدادات بعدد المشتركين فى كل الباقات
        //    - عدادات توضح اجمالي المتحصلات المالية من كل باقة شحن

        $allpackage = Package::all();
        $data = [];

        foreach ($allpackage as $index=>$package){
            $data[$index]['name_ar'] = $package->name_ar;
            $data[$index]['name'] = $package->name;
            $data[$index]['count_user'] = $package->user->count();
            $data[$index]['total_package'] = $package->packageUser->where('active_status',1)->sum('price');

        }
        //        عداد يوضح اجمالي المتحصلات المالية من كل الباقات
        $totalPackage = PackageUser::where('active_status',1)->sum('price');
        $data['total-amount-Package'] = $totalPackage;

        return $this->returnData('date', $data, 'successfully');

    }

    public function allAdminNewMonth()
    {
        //    - جدول يحتول على بيانات كافة المشتركين الجديد فى نفس اليوم
        $admin = User::whereMonth('created_at',now()->format('m'))->where('user_type','admin')->get();
        return $this->returnData('admin', $admin, 'successfully');

    }


    public function  customersPackage($id){

        // عدادات بعدد المشتركين فى كل نوع من انواع الباقات وتكون تلك العدادات
        // click able  عند الضغط عليه تظهر بيانات العملاء المشتركين فى تلك الباقة
        $admin = User::where([['user_type','admin'],['package_id',$id]])->get();
        return $this->returnData('admin', $admin, 'successfully');


    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function activeUserPackage($id)
    {
        $user = User::where('id',$id)->findOrFail($id);
        $user->update([
            'is_active' => 1
        ]);
        $pakage_user =PackageUser::where('user_id',$user->id)->latest()->first();
        $pakage_user->update([
            'active_status' => 1,
        ]);
        return $this->returnData('user', $user, 'successfully');

    }

    public function noActiveUserPackage($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'is_active' => 0
        ]);
        return $this->returnData('user', $user, 'successfully');

    }
}
