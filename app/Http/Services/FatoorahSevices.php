<?php
namespace App\Http\Services;



use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

//use http\Client;

class FatoorahSevices{
    private $base_url;
    private $headers;
    private $request_client;

    /**
     * FatoorahSevices constructor.
     * @param Client $request_client
     */
    public function __construct(Client $request_client){

        $this->request_client = $request_client;
        $this->base_url = env('fatoora_base_url');
        $this->headers =[
            'Content-Type'=>'application/json',
            'authorization'=>'Bearer '.env('fatoora_token'),
        ];
    }
    private function buildRequest($url,$method, array $data)
    {

        $request = new Request($method, $this->base_url . $url,$this->headers);

        if(!$data)
            return false;

        $response = $this->request_client->send($request,[
            'json' => $data
        ]);

        if($response->getStatusCode() != 200)
            return false;

        $response = json_decode($response->getBody(),true);

        return $response;
    }



    // send Payment

    public function sendPayment (array $data)
    {
        $response = $this->buildRequest('v2/SendPayment','POST',$data);
        return $response;
    }

    // success Payment

    public function successPayment (array $data)
    {
        $response = $this->buildRequest('v2/getPaymentStatus','POST',$data);
        return $response;
    }

    // Refund Payment

    public function RefundPayment (array $data)
    {
        $response = $this->buildRequest('v2/MakeRefund','POST',$data);
        return $response;
    }




}
