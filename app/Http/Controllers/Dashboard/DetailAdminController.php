<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Mail\khaled;
use App\Mail\SendMailMyFatorah;
use App\Models\Package;
use App\Models\PackageUser;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

            $data['package'][$index]['name_ar'] = $package->name_ar;
            $data['package'][$index]['name'] = $package->name;
            $data['package'][$index]['count_user'] = $package->user->count();
            $data['package'][$index]['total_package'] = $package->packageUser->where('active_status',1)->sum('price');

//            $data[]=['name_ar'=>$package->name_ar,
//                "name"=>$package->name,'count_user'=>$package->user->count(),'total_package'=>$package->packageUser->where('active_status',1)->sum('price')];

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
    public function test(Request $request)
    {

//
//        $data = array(
//            'email' => $request->email,
//            'subject' => 'welcome message',
//            'body' => 'Dear Dr:<h4>'.$request->name.'</h4>
//            </br>
//            Thanks for showing your interest to join our programs ,
//            </br>
//            you have successfully completed your registration form to apply to our specialty programs,
//            </br>
//            we will shortly inform you with all the details to proceed with your application process.
//             </br>
//            We wish you the best of luck.',
//
//        );
//        Mail::send('frontend.mailregister', $data, function($message) use ($data){
//            $message->from('Admission@rdi-int.co.uk' , 'Royal Dent Institute ');
//            $message->to($data['email']);
//            $message->subject($data['subject']);
//        })
//
//





//        Mail::to('alaazaza846@gmail.com')->send(new SendMailMyFatorah());
        Mail::to('alaazaza846@gmail.com')->send(new khaled());



//        send('', array(
//
//            'first_name' => 'sdasdasd',
//
//            'last_name' => 'asdassad',
//
//            'topic' => 'asdassad',
//            'identification' => 'asdassad',
//
//            'message_one' => 'asdassad',
//
//            'email' => 'asdassad',
//            'country_id' => 'asdassad',
//
//            'product_id' => 'asdassad',
//
//            'subject' => "hlooy",
//
//
//        ), function($message) use ($request){
//
//            $message->from('info@imansoliman.com', 'Admin');
//
//            $message->to();
//            $message->subject('test');
////            $message->to($user->email, 'Admin')->subject($request->get('topic'));
//
//        });

    }
}
