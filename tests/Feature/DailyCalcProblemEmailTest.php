<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;

uses(RefreshDatabase::class);
beforeEach(function () {
    $this->seed(); // Seed the database
});

it('sends an email with a calc problem', function () {
    // Spy on the Artisan facade
    $spy = Artisan::spy();
    // run command
    Artisan::call('email:send-daily-calc-problems');
    // Assert that the email job was dispatched
    $spy->shouldHaveReceived('call')->with('send:daily-calc-problems');
})->only();
