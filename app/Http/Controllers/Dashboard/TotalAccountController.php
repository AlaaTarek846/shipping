<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Company;
use App\Models\RepresentativeAccountDetail;
use App\Models\Shipment;
use App\Models\CompanyShipmentDetails;
use App\Models\Client;
use App\Models\DetailShipmentRepresentative;
use App\Traits\GeneralTrait;
use App\Traits\ShipmentTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TotalAccountController extends Controller
{
    use GeneralTrait;
    use ShipmentTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = [];

        /* 01- احصائية باجمالي  المتحصلات النقدية خلال يوم فتح الداش بورد */
        $total_day_shipment = RepresentativeAccountDetail::whereDate('created_at', now()->format('Y-m-d'))->sum('collection_balance');

        /* 02- احصائية بعدد الشحنات المطلوب تسليمها خلال يوم فتح الداش بورد */
        $shipment = Shipment::where('shipment_status_id', 6)->whereDate('delivery_date', now()->format('Y-m-d'))->count();

        /* 03- احصائية بأجمالي ال COD  المستحقة لكل العملاء  */
        $total_cod = CompanyShipmentDetails::whereDate('created_at', now()->format('Y-m-d'))->get();
        $total_price_cod = 0;
        foreach ($total_cod as $cod) {
            $total_price_cod += ($cod->shipment_price + $cod->shipment->shipping_price);
        }
        /* 04-احصائية بمستحقات المناديب فى يوم فتح الداش بورد */
        $total_day_commission = RepresentativeAccountDetail::whereDate('created_at', now()->format('Y-m-d'))->sum('commission');

        /* 05- احصائية بعدد العملاء لدي شركة الشحن */
        $conut_client = Client::where('user_id', '!=', null)->count();

        /*06- احصائية بعدد العملاء الجدد  */
        $conut_client_new = Client::
        where(function ($q) {
            $q->whereYear('created_at', now()->format('Y'))
                ->whereMonth('created_at', now()->format('m'))
                ->where('user_id', '!=', null);

        })->count();

        /* 07- احصائية بعدد المرتجعات فى نفس يوم فتح الداش بورد */
        $count_Shipment_return = Shipment::
        where(function ($q) {
            $q->whereDate('updated_at', now()->format('Y-m-d'))
                ->where('shipment_status_id', 8);
        })
            ->orWhere(function ($q) {
                $q->whereDate('updated_at', now()->format('Y-m-d'))
                    ->where('shipment_status_id', 9);
            })
            ->orWhere(function ($q) {
                $q->whereDate('updated_at', now()->format('Y-m-d'))
                    ->where('shipment_status_id', 10);
            })
            ->orWhere(function ($q) {
                $q->whereDate('updated_at', now()->format('Y-m-d'))
                    ->where('shipment_status_id', 11);
            })->count();

        /* 08 - احصائية بمتوسط التسليمات    */
        $count_Shipment_average = Shipment::
        where('shipment_status_id', 7)
            ->orWhere('shipment_status_id', 8)
            ->orWhere('shipment_status_id', 10)->count();

        /* 09- احصائية باكثر المناطق طلب شحن */
        $max_shipping_area = Area::withCount('shipment')->orderBy('shipment_count', 'desc')->get()->where('shipment_count', '>', 0)->take(3);

        /* 10  - احصائية باقل المناطق طلب شحن   */
        $min_shipping_area = Area::withCount('shipment')->orderBy('shipment_count', 'asc')->get()->where('shipment_count', '>', 0)->take(3);

        /* 11 - احصائية بمتوسط عدد الشحنات التي تم تسليمها فى الموعد المحدد كنسبة  */
        $shipment_average_deliverables = Shipment::where('shipment_status_id', 7)->whereDate('updated_at', now()->format('Y-m-d'))->count();

        $shipment_averages = Shipment::where('shipment_status_id', 7)->get()->filter(function ($shipment_average) {

            return $shipment_average->updated_at->format('Y-m-d') == $shipment_average->delivery_date;
        })->count();

        $total_shipment_average_deliverables = ($shipment_average_deliverables * $shipment_averages) / 100;

        /* 12 - احصائية بمتوسط عدد الشحنات التي لم يتم تسليمها فى الموعد المحدد كنسبة   */
        $shipment_average_deliverables_no = Shipment::where('shipment_status_id', 7)->whereDate('updated_at', now()->format('Y-m-d'))->count();

        $shipment_averages_no = Shipment::where('shipment_status_id', 7)->get()->filter(function ($shipment_average_no) {

            return $shipment_average_no->updated_at->format('Y-m-d') != $shipment_average_no->delivery_date;
        })->count();

        $total_shipment_average_deliverables_no = ($shipment_average_deliverables_no * $shipment_averages_no) / 100;


        /* 1*/
        $data['total_shipment_day'] = $total_day_shipment;
        /* 2*/
        $data['count_shipment_tslem_to_day'] = $shipment;
        /* 3*/
        $data['total_cod'] = $total_price_cod;
        /* 4*/
        $data['total_day_commission'] = $total_day_commission;
        /* 5*/
        $data['conut_client'] = $conut_client;
        /* 6*/
        $data['conut_client_new'] = $conut_client_new;
        /* 7*/
        $data['count_Shipment_return'] = $count_Shipment_return;
        /* 8*/
        $data['count_Shipment_average'] = $count_Shipment_average;
        /* 9*/
        $data['max_shipping_area'] = $max_shipping_area;
        /* 10*/
        $data['min_shipping_area'] = $min_shipping_area;
        /* 11*/
        $data['total_shipment_average_deliverables'] = $total_shipment_average_deliverables;
        /* 12*/
        $data['total_shipment_average_deliverables_no'] = $total_shipment_average_deliverables_no;

        return $this->returnData('data', $data, 'successfully');

    }

    public function index_Company($id)
    {

        $data = [];
        $user_company = Company::find($id)->user;

        /*-01احصائية باجمالي المتحصلات النقدية خلال يوم فتح الداش بورد */
        $total_day_shipment = CompanyShipmentDetails::where('company_id', $id)->whereDate('created_at', now()->format('Y-m-d'))->sum('shipment_price');

        /* 02- احصائية بعدد الشحنات المطلوب تسليمها خلال يوم فتح الداش بورد */

        $shipment = Shipment::
        where([['shipment_status_id', 6], ['sender_id', $user_company->id]])->whereDate('delivery_date', now()->format('Y-m-d'))->count();


        /* 03- احصائية بأجمالي ال COD  المستحقة لكل العملاء  */
        $total_cod = CompanyShipmentDetails::where('company_id', $id)->whereDate('created_at', now()->format('Y-m-d'))->get();
        $total_price_cod = 0;
        foreach ($total_cod as $cod) {
            $total_price_cod += ($cod->shipment_price + $cod->shipment->shipping_price);
        }
        /* 05- احصائية بعدد العملاء لدي شركة الشحن */
        $conut_client = Client::whereHas('shipment', function ($q) use ($user_company) {
            return $q->where('sender_id', '=', $user_company->id);
        })->where('user_id', '!=', null)->count();

        /*06- احصائية بعدد العملاء الجدد  */
        $conut_client_new = Client::
        whereHas('shipment', function ($q) use ($user_company) {
            $q->whereYear('created_at', now()->format('Y'))
                ->whereMonth('created_at', now()->format('m'))
                ->where([['user_id', '!=', null], ['sender_id', '=', $user_company->id]]);

        })->count();

        /* 07- احصائية بعدد المرتجعات فى نفس يوم فتح الداش بورد */
        $count_Shipment_return = Shipment::
        where(function ($q) use ($user_company) {
            $q->whereDate('updated_at', now()->format('Y-m-d'))
                ->where([['shipment_status_id', 8], ['sender_id', $user_company->id]]);
        })
            ->orWhere(function ($q) use ($user_company) {
                $q->whereDate('updated_at', now()->format('Y-m-d'))
                    ->where([['shipment_status_id', 9], ['sender_id', $user_company->id]]);
            })
            ->orWhere(function ($q) use ($user_company) {
                $q->whereDate('updated_at', now()->format('Y-m-d'))
                    ->where([['shipment_status_id', 10], ['sender_id', $user_company->id]]);
            })
            ->orWhere(function ($q) use ($user_company) {
                $q->whereDate('updated_at', now()->format('Y-m-d'))
                    ->where([['shipment_status_id', 11], ['sender_id', $user_company->id]]);
            })->count();

        /* 08 - احصائية بمتوسط التسليمات    */
        $count_Shipment_average = Shipment::
        where([['shipment_status_id', 7], ['sender_id', $user_company->id]])
            ->orWhere([['shipment_status_id', 8], ['sender_id', $user_company->id]])
            ->orWhere([['shipment_status_id', 10], ['sender_id', $user_company->id]])->count();

        /* 09- احصائية باكثر المناطق طلب شحن */
        $max_shipping_area = Area::whereHas('shipment', function ($q) use ($user_company) {
            return $q->where('sender_id', '=', $user_company->id);
        })->withCount('shipment')->orderBy('shipment_count', 'desc')->get()->where('shipment_count', '>', 0)->take(3);

        /* 10  - احصائية باقل المناطق طلب شحن   */
        $min_shipping_area = Area::whereHas('shipment', function ($q) use ($user_company) {
            return $q->where('sender_id', '=', $user_company->id);
        })->withCount('shipment')->orderBy('shipment_count', 'asc')->get()->where('shipment_count', '>', 0)->take(3);

        /* 11 - احصائية بمتوسط عدد الشحنات التي تم تسليمها فى الموعد المحدد كنسبة  */
        $shipment_average_deliverables = Shipment::where([['shipment_status_id', 7], ['sender_id', $user_company->id]])->whereDate('updated_at', now()->format('Y-m-d'))->count();

        $shipment_averages = Shipment::where([['shipment_status_id', 7], ['sender_id', $user_company->id]])->get()->filter(function ($shipment_average) {

            return $shipment_average->updated_at->format('Y-m-d') == $shipment_average->delivery_date;
        })->count();
        $total_shipment_average_deliverables = ($shipment_average_deliverables * $shipment_averages) / 100;

        /* 12 - احصائية بمتوسط عدد الشحنات التي لم يتم تسليمها فى الموعد المحدد كنسبة   */
        $shipment_average_deliverables_no = Shipment::where([['shipment_status_id', 7], ['sender_id', $user_company->id]])->whereDate('updated_at', now()->format('Y-m-d'))->count();

        $shipment_averages_no = Shipment::where([['shipment_status_id', 7], ['sender_id', $user_company->id]])->get()->filter(function ($shipment_average_no) {

            return $shipment_average_no->updated_at->format('Y-m-d') != $shipment_average_no->delivery_date;
        })->count();

        $total_shipment_average_deliverables_no = ($shipment_average_deliverables_no * $shipment_averages_no) / 100;


        /* 1*/
        $data['total_shipment_day'] = $total_day_shipment;
        /* 2*/
        $data['count_shipment_tslem_to_day'] = $shipment;
        /* 3*/
        $data['total_cod'] = $total_price_cod;
        /* 5*/
        $data['conut_client'] = $conut_client;
        /* 6*/
        $data['conut_client_new'] = $conut_client_new;
        /* 7*/
        $data['count_Shipment_return'] = $count_Shipment_return;
        /* 8*/
        $data['count_Shipment_average'] = $count_Shipment_average;
        /* 9*/
        $data['max_shipping_area'] = $max_shipping_area;
        /* 10*/
        $data['min_shipping_area'] = $min_shipping_area;
        /* 11*/
        $data['total_shipment_average_deliverables'] = $total_shipment_average_deliverables;
        /* 12*/
        $data['total_shipment_average_deliverables_no'] = $total_shipment_average_deliverables_no;


        return $this->returnData('data', $data, 'successfully');


    }

    public function index_stuts_shipment()
    {

        $data = [];

        /* نسبة الشحنات  تسليم ناجح - 1 */
        $all_shipment = Shipment::count();
        $stuts_7_shipment = Shipment::where('shipment_status_id', 7)->count();
        $total_status_7 = $stuts_7_shipment / $all_shipment * 100;

        /* نسبة الشحنات المرتجعه  - 2 */
        $stuts_mortg3_shipment = Shipment::
        where('shipment_status_id', 8)
            ->orWhere('shipment_status_id', 9)
            ->count();
        $total_status_8_9 = $stuts_mortg3_shipment / $all_shipment * 100;

        /* نسبة الشحنات  فشل التسليم  - 3  */
        $stuts_fashal_shipment = Shipment::
        where('shipment_status_id', 10)
            ->orWhere('shipment_status_id', 11)
            ->count();
        $total_status_10_11 = $stuts_fashal_shipment / $all_shipment * 100;

        /* ⦁	نسبة الشحنات المؤجلة  - 4  */
        $stuts_moagla_shipment = Shipment::
        where('shipment_status_id', 12)->count();
        $total_status_12 = $stuts_moagla_shipment / $all_shipment * 100;

        /* ⦁	نسبة استلام ال pick up  - 5  */
        $stuts_pick_up_shipment = DetailShipmentRepresentative::
        where('shipment_status_id', 3)
            ->count();
        $total_status_3 = $stuts_pick_up_shipment / $all_shipment * 100;


        /* 1*/
        $data[] = $total_status_7;
        /* 2*/
        $data[] = $total_status_8_9;
        /* 3*/
        $data[] = $total_status_10_11;
        /* 4*/
        $data[] = $total_status_12;
        /* 5*/
        $data[] = $total_status_3;

        return $this->returnData('data', $data, 'successfully');


    }

    public function index_count_month_shipment()
    {

        $month = now()->month;
        $year = now()->year;

        $data[1] = ['month' => $month, 'year' => $year];
        for ($i = 2; $i < 13; $i++) {
            if ($month == 1) {
                $month = 12;
                $year -= 1;
                $data[$i] = ['month' => $month, 'year' => $year];
            } else {
                $data[$i] = ['month' => $month - 1, 'year' => $year];
                $month -= 1;
            }
        }

        $array = [];
        foreach ($data as $item) {
            $array[] = Shipment::whereMonth('created_at', $item['month'])->whereYear('created_at', $item['year'])->count();
        }


//        return $array;

        return $this->returnData('array', $array, 'successfully');


    }

    public function index_count_year_shipment()
    {

//        $month = now()->month;
        $year = now()->year;

        $data[1] = [ 'year' => $year];
        for ($i = 2; $i < 12; $i++) {
            if ($year == 1) {

                $data[$i] = [ 'year' => $year];
            } else {
                $data[$i] = ['year' => $year - 1,];
                $year -= 1;
            }
        }

        $array = [];
        foreach ($data as $item) {
            $array[] = Shipment::whereYear('created_at', $item['year'])->count();
        }

//        return $array;

        return $this->returnData('array', $array, 'successfully');


    }

    public function month_shipment(){

        $data = [];

        /* 1 عدد الاوردارات */
        $month_total_shipment = Shipment::whereYear('created_at', now()->format('Y'))->whereMonth('created_at', now()->format('m'))->count();

        /* 2 قيمة الاوردرات */
        $month_total_shipment_price = Shipment::whereYear('created_at', now()->format('Y'))->whereMonth('created_at', now()->format('m'))->get()->sum('total_shipment');

        /* 3 ⦁	ما تم توريدة */
        $supplied_shipment = RepresentativeAccountDetail::whereYear('created_at', now()->format('Y'))->whereMonth('created_at', now()->format('m'))->count();

        /* 4 ⦁	ما تم توريدة قيمة*/
        $supplied_shipment_price = RepresentativeAccountDetail::whereYear('created_at', now()->format('Y'))->whereMonth('created_at', now()->format('m'))->sum('collection_balance');

        /* 5 ⦁	⦁	الاوردرات المستلمة*/
        $shipment_count_status_7 = RepresentativeAccountDetail::whereYear('created_at', now()->format('Y'))->whereMonth('created_at', now()->format('m'))->where('shipment_status_id',7)->count();

        /* 6 ⦁	⦁	الاوردرات المستلمة*/
        $shipment_count_status_10_11 = RepresentativeAccountDetail::
        whereYear('created_at', now()->format('Y'))
            ->whereMonth('created_at', now()->format('m'))
            ->where('shipment_status_id',10)
            ->orWhere('shipment_status_id',11)
            ->count();

        /* 1*/
        $data[] = $month_total_shipment;
       /* 2 */
        $data[] = $month_total_shipment_price;
        /* 3 */
        $data[] = $supplied_shipment;
        /* 4 */
        $data[] = $supplied_shipment_price;
        /* 5 */
        $data[] = $shipment_count_status_7;
        /* 5 */
        $data[] = $shipment_count_status_10_11;


        return $this->returnData('data', $data, 'successfully');

    }

    public function Year_shipment(){

        $data = [];

        /* 1 عدد الاوردارات */
        $month_total_shipment = Shipment::whereYear('created_at', now()->format('Y'))->count();

        /* 2 قيمة الاوردرات */
        $month_total_shipment_price = Shipment::whereYear('created_at', now()->format('Y'))->get()->sum('total_shipment');

        /* 3 ⦁	ما تم توريدة */
        $supplied_shipment = RepresentativeAccountDetail::whereYear('created_at', now()->format('Y'))->count();

        /* 4 ⦁	ما تم توريدة قيمة*/
        $supplied_shipment_price = RepresentativeAccountDetail::whereYear('created_at', now()->format('Y'))->sum('collection_balance');

        /* 5 ⦁	⦁	الاوردرات المستلمة*/
        $shipment_count_status_7 = RepresentativeAccountDetail::whereYear('created_at', now()->format('Y'))->count();

        /* 6 ⦁	⦁	الاوردرات المستلمة*/
        $shipment_count_status_10_11 = RepresentativeAccountDetail::
        whereYear('created_at', now()->format('Y'))
            ->where('shipment_status_id',10)
            ->orWhere('shipment_status_id',11)
            ->count();

        /* 1*/
        $data[] = $month_total_shipment;
        /* 2 */
        $data[] = $month_total_shipment_price;
        /* 3 */
        $data[] = $supplied_shipment;
        /* 4 */
        $data[] = $supplied_shipment_price;
        /* 5 */
        $data[] = $shipment_count_status_7;
        /* 5 */
        $data[] = $shipment_count_status_10_11;


        return $this->returnData('data', $data, 'successfully');

    }

    public function  customer(){

        $data = [];

        /* 1⦁	احصائية باعداد العملاء */
        $customer_count = Client::count();

        /* 2 ⦁	احصائية باعداد العملاء الجدد */
        $customer_count_now = Client::whereMonth('created_at', now()->format('m'))->count();

        /* 1 */
        $data[] = $customer_count;
        /* 2 */
        $data[] = $customer_count_now;
        /* 3 */
//        $data[] = $customer_count_now;


        return $this->returnData('data', $data, 'successfully');
    }

    public function count_all()
    {

        $data = [];

        /* نسبة الشحنات  تسليم ناجح - 1 */
        $stuts_7_shipment = Shipment::where('shipment_status_id', 7)->count();

        /* نسبة الشحنات المرتجعه  - 2 */
        $stuts_mortg3_shipment = Shipment::
        where('shipment_status_id', 8)
            ->orWhere('shipment_status_id', 9)
            ->orWhere('shipment_status_id', 10)
            ->orWhere('shipment_status_id', 11)
            ->count();

        /* ⦁	نسبة الشحنات المؤجلة  - 4  */
        $stuts_moagla_shipment = Shipment::
        where('shipment_status_id', 12)->count();




        /* 1*/
        $data[] = $stuts_7_shipment;
        /* 2*/
        $data[] = $stuts_mortg3_shipment;
        /* 3*/
        $data[] = $stuts_moagla_shipment;


        return $this->returnData('data', $data, 'successfully');


    }

    public function count_Company($id)
    {

        $data = [];

        $user_company = Company::find($id)->user;

        /* نسبة الشحنات  تسليم ناجح - 1 */
        $stuts_7_shipment = Shipment::where([['shipment_status_id', 7],['sender_id',$user_company->id]])->count();

        /* نسبة الشحنات المرتجعه  - 2 */
        $stuts_mortg3_shipment = Shipment::
        where([['shipment_status_id', 8],['sender_id',$user_company->id]])
            ->orWhere([['shipment_status_id', 9],['sender_id',$user_company->id]])
            ->count();


        /* ⦁	نسبة الشحنات المؤجلة  - 4  */
        $stuts_moagla_shipment = Shipment::
        where([['shipment_status_id', 12],['sender_id',$user_company->id]])->count();


        /* 1*/
        $data[] = $stuts_7_shipment;
        /* 2*/
        $data[] = $stuts_mortg3_shipment;
        /* 3*/
        $data[] = $stuts_moagla_shipment;


        return $this->returnData('data', $data, 'successfully');


    }



    public function index_stuts_shipment_company($id)
    {

        $data = [];

        $user_company = Company::find($id)->user;

        /* نسبة الشحنات  تسليم ناجح - 1 */
        $all_shipment = Shipment::count();
        $stuts_7_shipment = Shipment::where([['shipment_status_id', 7],['sender_id',$user_company->id]])->count();
        $total_status_7 = $stuts_7_shipment / $all_shipment * 100;

        /* نسبة الشحنات المرتجعه  - 2 */
        $stuts_mortg3_shipment = Shipment::
        where([['shipment_status_id', 8],['sender_id',$user_company->id]])
            ->orWhere([['shipment_status_id', 9],['sender_id',$user_company->id]])
            ->count();
        $total_status_8_9 = $stuts_mortg3_shipment / $all_shipment * 100;

        /* نسبة الشحنات  فشل التسليم  - 3  */
        $stuts_fashal_shipment = Shipment::
        where([['shipment_status_id', 10],['sender_id',$user_company->id]])
            ->orWhere([['shipment_status_id', 11],['sender_id',$user_company->id]])
            ->count();
        $total_status_10_11 = $stuts_fashal_shipment / $all_shipment * 100;

        /* ⦁	نسبة الشحنات المؤجلة  - 4  */
        $stuts_moagla_shipment = Shipment::
        where([['shipment_status_id', 12],['sender_id',$user_company->id]])->count();
        $total_status_12 = $stuts_moagla_shipment / $all_shipment * 100;


        /* 1*/
        $data[] = $total_status_7;
        /* 2*/
        $data[] = $total_status_8_9;
        /* 3*/
        $data[] = $total_status_10_11;
        /* 4*/
        $data[] = $total_status_12;


        return $this->returnData('data', $data, 'successfully');


    }


    public function index_count_month_shipment_company($id)
    {

        $month = now()->month;
        $year = now()->year;
        $user_company = Company::find($id)->user;


        $data[1] = ['month' => $month, 'year' => $year];
        for ($i = 2; $i < 13; $i++) {
            if ($month == 1) {
                $month = 12;
                $year -= 1;
                $data[$i] = ['month' => $month, 'year' => $year];
            } else {
                $data[$i] = ['month' => $month - 1, 'year' => $year];
                $month -= 1;
            }
        }

        $array = [];
        foreach ($data as $item) {
            $array[] = Shipment::whereMonth('created_at', $item['month'])->whereYear('created_at', $item['year'])->where('sender_id',$user_company->id)->count();
        }


//        return $array;

        return $this->returnData('array', $array, 'successfully');


    }

    public function index_count_year_shipment_company($id)
    {

//        $month = now()->month;
        $year = now()->year;
        $user_company = Company::find($id)->user;


        $data[1] = [ 'year' => $year];
        for ($i = 2; $i < 13; $i++) {
            if ($year == 1) {

                $data[$i] = [ 'year' => $year];
            } else {
                $data[$i] = ['year' => $year - 1,];
                $year -= 1;
            }
        }

        $array = [];
        foreach ($data as $item) {
            $array[] = Shipment::whereYear('created_at', $item['year'])->where('sender_id',$user_company->id)->count();
        }

//        return $array;

        return $this->returnData('array', $array, 'successfully');


    }

    public function month_shipment_company($id){

        $data = [];

        $user_company = Company::find($id)->user;


        /* 1 عدد الاوردارات */
        $month_total_shipment = Shipment::
        whereYear('created_at', now()->format('Y'))->whereMonth('created_at', now()->format('m'))->where('sender_id',$user_company->id)->count();

        /* 2 قيمة الاوردرات */
        $month_total_shipment_price = Shipment::
        whereYear('created_at', now()->format('Y'))->whereMonth('created_at', now()->format('m'))->where('sender_id',$user_company->id)->get()->sum('total_shipment');

        /* 3 ⦁	ما تم توريدة */
        $supplied_shipment = CompanyShipmentDetails::whereYear('created_at', now()->format('Y'))->whereMonth('created_at', now()->format('m'))->where('company_id',$id)->count();

        /* 4 ⦁	ما تم توريدة قيمة*/
        $supplied_shipment_price = CompanyShipmentDetails::whereYear('created_at', now()->format('Y'))->whereMonth('created_at', now()->format('m'))->where('company_id',$id)->sum('shipment_price');

        /* 5 ⦁	⦁	الاوردرات المستلمة*/
        $shipment_count_status_7 = CompanyShipmentDetails::whereYear('created_at', now()->format('Y'))->whereMonth('created_at', now()->format('m'))->where([['shipment_status_id',7],['company_id',$id]])->count();

        /* 6 ⦁	⦁	الاوردرات المستلمة*/
        $shipment_count_status_10_11 = CompanyShipmentDetails::
        whereYear('created_at', now()->format('Y'))
            ->whereMonth('created_at', now()->format('m'))
            ->where([['shipment_status_id',10],['company_id',$id]])
            ->orWhere([['shipment_status_id',11],['company_id',$id]])
            ->count();

        /* 1*/
        $data[] = $month_total_shipment;
        /* 2 */
        $data[] = $month_total_shipment_price;
        /* 3 */
        $data[] = $supplied_shipment;
        /* 4 */
        $data[] = $supplied_shipment_price;
        /* 5 */
        $data[] = $shipment_count_status_7;
        /* 5 */
        $data[] = $shipment_count_status_10_11;


        return $this->returnData('data', $data, 'successfully');

    }

    public function Year_shipment_company($id){

        $data = [];
        $user_company = Company::find($id)->user;


        /* 1 عدد الاوردارات */
        $month_total_shipment = Shipment::whereYear('created_at', now()->format('Y'))->where('sender_id',$user_company->id)->get()->count();

        /* 2 قيمة الاوردرات */
        $month_total_shipment_price = Shipment::whereYear('created_at', now()->format('Y'))->where('sender_id',$user_company->id)->get()->sum('total_shipment');

        /* 3 ⦁	ما تم توريدة */
        $supplied_shipment = CompanyShipmentDetails::whereYear('created_at', now()->format('Y'))->where('company_id',$id)->get()->count();

        /* 4 ⦁	ما تم توريدة قيمة*/
        $supplied_shipment_price = CompanyShipmentDetails::whereYear('created_at', now()->format('Y'))->where('company_id',$id)->sum('shipment_price');

        /* 5 ⦁	⦁	الاوردرات المستلمة*/
        $shipment_count_status_7 = CompanyShipmentDetails::whereYear('created_at', now()->format('Y'))->where('company_id',$id)->count();

        /* 6 ⦁	⦁	الاوردرات المستلمة*/
        $shipment_count_status_10_11 = CompanyShipmentDetails::
        whereYear('created_at', now()->format('Y'))
            ->where([['shipment_status_id',10],['company_id',$id]])
            ->orWhere([['shipment_status_id',11],['company_id',$id]])
            ->count();

        /* 1*/
        $data[] = $month_total_shipment;
        /* 2 */
        $data[] = $month_total_shipment_price;
        /* 3 */
        $data[] = $supplied_shipment;
        /* 4 */
        $data[] = $supplied_shipment_price;
        /* 5 */
        $data[] = $shipment_count_status_7;
        /* 5 */
        $data[] = $shipment_count_status_10_11;


        return $this->returnData('data', $data, 'successfully');

    }

    public function  customer_company($id){

        $data = [];
        $user_company = Company::find($id)->user;

        /* 1⦁	احصائية باعداد العملاء */
        $customer_count = Client::whereHas('shipment', function ($q) use ($user_company) {
            return $q->where('sender_id', '=', $user_company->id);
        })->count();

        /* 2 ⦁	احصائية باعداد العملاء الجدد */
        $customer_count_now = Client::whereMonth('created_at', now()->format('m'))->whereHas('shipment', function ($q) use ($user_company) {
            return $q->where('sender_id', '=', $user_company->id);
        })->count();

        /* 1 */
        $data[] = $customer_count;
        /* 2 */
        $data[] = $customer_count_now;
        /* 3 */
//        $data[] = $customer_count_now;


        return $this->returnData('data', $data, 'successfully');
    }








    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
