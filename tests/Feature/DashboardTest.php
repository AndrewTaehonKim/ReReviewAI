<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

uses(RefreshDatabase::class);

it('shows the dashboard page', function () {
    $user = User::factory()->create();
    Auth::login($user);
    $response = $this->get('/dashboard');
    $response->assertStatus(200);
});
