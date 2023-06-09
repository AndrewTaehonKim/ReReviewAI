<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);
beforeEach(function () {
    $this->seed(); // Seed the database
});

it('makes and stores the calc problem for user and guest', function () {
    // initialize user object
    $user = User::factory()->create();

    // run the route as gues and as auth
    $response_auth = $this->actingAs($user)->post('/make-store-calc-problem', ['type'=>'power_rule'])->getContent();
    $response = $this->post('/make-store-calc-problem', ['type'=>'power_rule'])->getContent();
    
    // assertions and expectations
    expect($response_auth)->toBe('1'); // first problem
    expect($response)->toBe('2'); // second problem
});