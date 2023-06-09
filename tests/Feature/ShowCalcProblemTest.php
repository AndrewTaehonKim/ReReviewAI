<?php

use App\Http\Controllers\CalcProblemController;
use App\Models\CalcProblem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);
beforeEach(function () {
    $this->seed(); // Seed the database
});

it('has shows the calc problem on a page', function () {
    $user = User::factory()->create();
    $this->actingAs($user)->post('make-store-show-calc-problem', ['type' => 'power_rule']);
    $this->post('make-store-show-calc-problem', ['type' => 'power_rule']);

    // run the route as gues and as auth
    $response_auth = $this->actingAs($user)->get('calc-problem/1');
    $response = $this->get('calc-problem/2');

    // assertions and expectations
    $response_auth->assertStatus(200);
    $response->assertStatus(200);
});
