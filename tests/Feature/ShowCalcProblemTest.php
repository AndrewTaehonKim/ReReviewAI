<?php

use App\Http\Controllers\CalcProblemController;
use App\Models\CalcProblem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('has shows the calc problem on a page', function () {
    // generate fake problem data
    $problem = CalcProblem::factory()->create();
    // initialize CalcProblem Controller
    $contoller = new CalcProblemController();
    // run the function with problem object passed in
    $problem_id = $contoller->store($problem);
    // initialize user object
    $user = User::factory()->create();

    // run the route as gues and as auth
    $response_auth = $this->actingAs($user)->get('calc-problem/'.$problem_id);
    $response = $this->get('calc-problem/'.$problem_id);

    // assertions and expectations
    $response_auth->assertStatus(200);
    $response->assertStatus(200);
});
