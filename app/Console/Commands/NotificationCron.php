<?php

namespace App\Console\Commands;

use App\Models\Package;
use App\Models\User;
use App\Traits\NotificationTrait;
use Illuminate\Console\Command;

class NotificationCron extends Command
{
    use NotificationTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:cron';

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

        $packages = Package::whereHas('user',function ($q){
            $q->whereDate('package_date' , '<=' , now()->addDays(1))
                ->whereDate('package_date' , '>=' , now());
        })->get();
        $user = User::where('user_type','speradmin')->first();
        foreach ($packages as $package)
        {
            $package->count_user =  $package->user->count();

            $tokens = [];
            $tokens[] = $user->token;
            $title = "تنبية بمواعيد انتهاء الاشتراكات !";
            $body = " مواعيد تجديد عملاء باقة $package->name_ar ($package->count_user)";
            $request =  $user->id;

            $this->notification($tokens,$body,$title,$request);
        }
    }
}
