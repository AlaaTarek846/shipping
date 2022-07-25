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
    public  $user_fatoor;

    public function __construct($user)
    {
        $this->user_fatoor = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@imansoliman.com', 'Innovations')->markdown('mail.Fatorah',['user'=>$this->user_fatoor]);
    }
}
