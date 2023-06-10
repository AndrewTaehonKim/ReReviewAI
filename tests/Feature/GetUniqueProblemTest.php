<?php

use App\Models\CalcProblem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(); // Seed the database
});

it('returns the id of a problem that has not been seen by the user', function () {
    // Generate two random users
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    // Make and store problem by 2 users
    $this->actingAs($user1)->post('/make-store-show-calc-problem', ['type'=>'power_rule']);
    $this->actingAs($user2)->post('/make-store-show-calc-problem', ['type'=>'power_rule']);

    // run the controller function for getting a unique calc problem
    $response1 = $this->actingAs($user1)->post('/get-unique-calc-problem', ['type'=>'power_rule'])->getContent();
    $response2 = $this->actingAs($user2)->post('/get-unique-calc-problem', ['type'=>'power_rule'])->getContent();
    Auth::logout();
    $response = $this->post('/get-unique-calc-problem', ['type'=>'power_rule'])->getContent();

    // expectations and assertions
    expect($response1)->toBeIn(['1','3']);
    expect($response2)->toBeIn(['1','2']);
    expect($response)->toBeIn(['1', '2', '3']);
});
