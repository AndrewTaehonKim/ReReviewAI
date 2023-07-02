<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Http\Controllers\CalcProblemController;
use App\Models\CalcProblem;
use App\Models\User;
use App\Notifications\DailyCalcProblem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SendTestCalcEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends a test email to myself';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // get all users
        $user = User::find(2);
        $problem_type = 'power_rule';
        $request = new Request(['type' => $problem_type]);
        $calcProblemController = new CalcProblemController();

        // Set the authenticated user
        Auth::login($user);
        // get unique problem id
        $problemID = $calcProblemController->getUniqueProblem($request);

        $problem = CalcProblem::FindorFail($problemID);
        $calcEmail = $calcProblemController->makeEmailData($problem);
        $user->notify(new DailyCalcProblem($calcEmail));
        Auth::logout();

        $this->info('Emails Sent.');
    }
}
