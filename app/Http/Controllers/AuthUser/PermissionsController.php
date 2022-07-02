<?php

namespace App\Http\Controllers\AuthUser;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{

    public function getPermissions(){

        $arr = [

            'users' => 'users',
            'additional_services' => 'خدمات اضافية',
            'admins' => 'admins',
            'advertisements' => 'الاعلانات',
            'areas' => 'المناطق',
            'branches' => 'الفروع',
            'clients' => 'العملاء',
            'companies' => 'شركات',
            'company_accounts' => 'حسابات الشركات',
            'company_shipment_details' => 'تفاصيل شحنات المندوب',
            'company_shipping_area_prices' => 'مناطق الشركات',
            'complains' => 'الشكاوي',
            'connects' => 'اتصل بنا',
            'countries' => 'الدول',
            'departments' => 'الاقسام',
            'detail_shipment_representatives' => 'تحركات المندوب',
            'employees' => 'الموظفين',
            'expenses' => 'مصروفات',
            'incomes' => ' الايرادات',
            'import_shipmentts' => 'ملف الاكسل',
            'jobs' => 'الوظائف',
            'income_and_expenses' => 'المنصرف',
            'maps' => 'عرض خريظة المندوب',
            'messages' => 'الرسائل',
            'message_representatives' => 'رسائل المندوب',
            'offers' => 'العروض',
            'offer_companies' => 'اشتراك عروض الشركات',
            'payment_types' => 'انواع الدفع',
            'pick_ups' => 'بيك اب',
            'provinces' => 'المحافظات',
            'reasons' => 'الاسباب فشل الشحنه',
            'representatives' => 'المندوب',
            'representative_accounts' => 'حساب المندوب',
            'representative_account_details' => 'تفاصيل شحنات المندوب',
            'representative_areas' => ' مناطق المندوب',
            'representative_moves' => ' الجدول معمول بس مش شغال دلوقتي تحركات  المندوب',
            'shipments' => 'الشحنات',
            'shipment_status' => 'الحالات الشحنات',
            'shipment_transfers' => ' الجدول معمول بس مش شغال دلوقتي نقل  الشحنات',
            'shipment_types' => ' الجدول معمول بس مش شغال دلوقتي نوع الشحنات ',
            'shipping_area_prices' => 'المناطق العامه',
            'storage_systems' => 'انواع المخازن',
            'storage_system_companies' => 'اشتراك المخازن الشركات',
            'stores' => 'المخازن',
            'transferring_treasuries' => 'نقل من خزنة لي خزنة',
            'transport_types' => 'نوع نقل الشحنة',
            'treasuries' => 'الخزنة',
            'weights' => 'الوزن العام',
            'weight_companies' => 'الوزن للشريكات'


        ];
        $array1=[];
        foreach($arr as $key=>$da)
        {

            $array1[]=array($key=>$da);
        }

        // return [$array1];

        $arr2 = [
            'create' => 'اضافة',
            'read' => 'قراءة',
            'update' => 'تعديل',
            'delete' => 'حذف'
        ];

        $array2=[];
        foreach($arr2 as $key=>$da)
        {

            $array2[]=array($key=>$da);
        }
        // return [$array2];


        // return [$arr];

        return $data = array( $array1, $array2);

    }
    public function syncPermissions(User $user , Request $request){
        $validation = \Illuminate\Support\Facades\Validator::make($request->all(),[
            'permissions' => 'required',
        ]);
        if ($validation->fails())
        {
            return response()->json($validation->errors(), 422);
        }

        $user->syncPermissions($request->permissions);

        return $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
}
