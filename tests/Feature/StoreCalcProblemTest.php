<?php

use App\Http\Controllers\CalcProblemController;
use App\Models\CalcProblem;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('stores the generated problem data into the table and redirects', function () {
    // generate fake problem data
    $problem = CalcProblem::factory()->create();
    // initialize CalcProblem Controller
    $contoller = new CalcProblemController();

    // run the function with problem object passed in
    $response = $contoller->store($problem);
    // Assert that the problem data is stored in the table
    $this->assertDatabaseCount('calc_problems', 1);
    expect($response)->toBe(1);

})->group('CalcProblemControllerPrivate')->skip();
// change method to public before testing
