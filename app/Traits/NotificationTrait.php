<?php
namespace App\Traits;

//use GuzzleHttp\Client;
use App\Models\Notification;
use Log;

/**
 * trait NotificationTrait
 */
trait NotificationTrait
{
    public function notification($tokens,$body,$title,$request){

        $SERVER_API_KEY = 'AAAA8chGpmw:APA91bEN5L_d34Tr5U_CsqKCsPYVGvvrkc-p7rhfR0T4_0xHevwWq_THtJ4Qt0BeL9OA1IZHGUFtJNGUfUwHAKv-9c4CURxRqOcmD7aNzkxBnAskfCd2XQzZ-UfWneb1-0Fb1Nc5Fzon';

        $data = [

            "registration_ids" => $tokens,

//            "data" => [
//                'type' => $type,
//                'productData' => json_encode($productData),
//            ],

            "notification" => [

                "title" => $title,

                "body" => $body,

                "sound" => "default", // required for sound on ios

                // "image" =>asset('uploads/products/'.$product -> image),

                "click_action"=> "FLUTTER_NOTIFICATION_CLICK"

            ],

        ];

        $dataString = json_encode($data);

        $headers = [

            'Authorization: key=' . $SERVER_API_KEY,

            'Content-Type: application/json',

        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        Notification::create([

            "title" => $title,
            "body" => $body,
            "user_id" => $request,

        ]);

        return $response;
    }
}
