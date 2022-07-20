<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\Dashboard\PackageUserController;



class khaled extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public  $fatoor;
    public function __construct($data_fatoor)
    {
        $this->fatoor = $data_fatoor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@imansoliman.com', 'Admin')->markdown('mail.khaled',['fatoor' => $this->fatoor]);
    }
}
