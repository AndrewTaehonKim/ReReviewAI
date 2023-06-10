<?php

use App\Console\Commands\SendDailyCalcProblems;
use Illuminate\Foundation\Testing\RefreshDatabase;


uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(); // Seed the database
});

it('sends a calc email', function () {
    $command = new SendDailyCalcProblems();
    
    $response = $command->handle();
    
    expect($response)->toBe("Email Sent");
})->only();
