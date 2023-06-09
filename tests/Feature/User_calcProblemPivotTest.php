<?php
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(); // Seed the database
});

it('checks for the pivot table being updated when user creates a problem', function () {
    # Make calc problem
    $this->post('/make-store-calc-problem', ['type'=>'power_rule']);
    $user = User::factory()->create();
    Auth::login($user);

    // Make a GET request as the authenticated user
    $response = $this->actingAs($user)->get('/calc-problem/1');

    // assertions
    $response->assertStatus(200);
    $this->assertDatabaseCount ('user_calcProblem', 1);
});
