<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class LogCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:cron';

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
        $end_date = User::whereDate('package_date',now()->format('Y-m-d'))->get();
        foreach ($end_date as $aa){
            $aa->update([
                'is_active' => 0
            ]);
        }
    }
}
