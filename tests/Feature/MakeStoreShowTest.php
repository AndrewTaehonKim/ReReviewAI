<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;


uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(); // Seed the database
});

it('makes, stores, and shows the calc problem for user and guest', function () {
    // initialize user object
    $user = User::factory()->create();

    // run the route as gues and as auth
    $response_auth = $this->actingAs($user)->post('/make-store-show-calc-problem', ['type'=>'power_rule']);
    $response = $this->post('/make-store-show-calc-problem', ['type'=>'power_rule']);

    // assertions and expectations
    $response_auth->assertStatus(200);
    $response->assertStatus(200);
});