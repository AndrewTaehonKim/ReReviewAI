<?php

namespace App\Console\Commands;

use App\Http\Controllers\CalcProblemController;
use App\Models\CalcProblem;
use App\Models\User;
use App\Notifications\DailyCalcProblem;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // $users = User::all();
        $users = User::where('name', '!=', 'Test User')->get();

        $problem_type = 'power_rule';
        $request = new Request(['type' => $problem_type]);
        $calcProblemController = new CalcProblemController();
        // loop through each user
        foreach ($users as $user)
        {
            // Set the authenticated user
            Auth::login($user);
            // get unique problem id
            $problemID = $calcProblemController->getUniqueProblem($request);

            $problem = CalcProblem::FindorFail($problemID);
            $calcEmail = $calcProblemController->makeEmailData($problem);
            $user->notify(new DailyCalcProblem($calcEmail));
            Auth::logout();

        }

        // $this->info('Emails Sent.');
        return("Email Sent");
    }
}
