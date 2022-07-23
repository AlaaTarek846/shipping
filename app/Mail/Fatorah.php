<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\Dashboard\PackageUserController;



class Fatorah extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public  $fatoor;
    public  $user_fatoor;

    public function __construct($data_fatoor,$user)
    {
        $this->fatoor = $data_fatoor;
        $this->user_fatoor = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@imansoliman.com', 'Admin')->markdown('mail.Fatorah',['fatoor' => $this->fatoor,'user'=>$this->user_fatoor]);
    }
}
