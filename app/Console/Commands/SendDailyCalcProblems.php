<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\DailyCalcProblem;
use Illuminate\Console\Command;

class SendDailyCalcProblems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send-daily-calc-problems';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily calc problems';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // get all users
        $users = User::all();
        // loop through each user
        foreach ($users as $user)
        {
            $data =['test'=>'testing text'];
            $user->notify(new DailyCalcProblem($data));
        }

        $this->info('Emails Sent.');
    }
}
