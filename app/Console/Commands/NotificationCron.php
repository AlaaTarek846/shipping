<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class NotificationCron extends Command
{
    use NotificationTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = '';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $users = User::whereDate('package_date' , '<=' , now()->addDays(3))->get();
        foreach ($users as $user){

            //send notification
            $tokens = [];
            $tokens[] = $users>token;
            $title = "Shipping in";
            $body = "Shipping";
            $request =  $users->id;
            //02-  اشعار بوصول الشحنه رقم كذا ....... الى العميل اسمه كذا ........... رقم موبايل كذا .............  وحالة الشحنة ( مرتجع جزئي مسدد قيمة الشحن – مرتجع جزئي غير مسدد قيمة الشحن - ................ الخ )


            $this->notification($tokens,$body,$title,$request);

        }
    }
}
