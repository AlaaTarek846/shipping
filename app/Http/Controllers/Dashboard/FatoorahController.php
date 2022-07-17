<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Services\FatoorahSevices;
use App\Models\PaymentTransaction;
use Illuminate\Http\Request;

class FatoorahController extends Controller
{
    private    $fatoorahSevices;
    public function __construct(FatoorahSevices $fatoorahSevices){
        $this->fatoorahSevices = $fatoorahSevices;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'NotificationOption' => 'EML', //'SMS', 'EML', or 'ALL'
            'InvoiceValue'       => '50',
            'CustomerName'       => 'Alaa Tarek',
            'CustomerMobile'     => '01113667448',
            'DisplayCurrencyIso' => 'JOD',
            'MobileCountryCode'  => '+20',
            'CustomerEmail'      => 'alaazaza846@gmail.com',
            'CallBackUrl'        => 'http://dashboard-subscribe.innovations-eg.com/api/callBackUrl',
            'ErrorUrl'           => 'https://dashboard-subscribe.innovations-eg.com/api/errorUrl', //or 'https://example.com/error.php
            'Language'           => 'en', //or 'ar'



        ];
        $data_fatoor = $this->fatoorahSevices ->sendPayment($data);
        PaymentTransaction::create([
            'invoiceId' => $data_fatoor['Data']['InvoiceId'],
            'user_id' => 1,
            'status' => 0

        ]);

        return $data_fatoor;


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function callBackUrl(Request $request)
    {
        $data =[];
        $data ['key'] = $request->paymentId;
        $data ['keyType'] ='paymentId';
        $data_fatoor = $this->fatoorahSevices->successPayment($data);

        $PaymentTransaction = PaymentTransaction::where('invoiceId',$data_fatoor['Data']['InvoiceId'])->first();
        $PaymentTransaction->update([
            'status' => 1
        ]);


        return $data_fatoor;
    }
    public function errorUrl(Request $request)
    {


        return 'errorUrl';
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
