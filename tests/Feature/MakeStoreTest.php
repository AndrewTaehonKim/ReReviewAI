<?php

use App\Http\Controllers\CalcProblemController;
use Illuminate\Http\Request;

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);
beforeEach(function () {
    $this->seed(); // Seed the database
});

it('makes and stores the calc problem for user and guest', function () {
    
    
    // initialize user object
    $controller = new CalcProblemController();
    $request = new Request(['type'=>'power_rule']);

    // run the route as gues and as auth
    $response1 = $controller->makeStore($request);
    $response2 = $controller->makeStore($request);
    
    // assertions and expectations
    expect($response1)->toBe(1); // first problem
    expect($response2)->toBe(2); // second problem
})->group('CalcProblemControllerPrivate')->skip();