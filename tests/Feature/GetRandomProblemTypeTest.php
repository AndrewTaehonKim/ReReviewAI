<?php

namespace Tests\Feature;

use App\Http\Controllers\CalcProblemController;
use App\Models\PythonFile;

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(); // Seed the database
});

it('gets a random problem type', function () {
    $pythonFilesList =  PythonFile::pluck('filenameWithoutExtension')->toArray();
    $calcProblemController = new CalcProblemController();
    $response = $calcProblemController->getRandomProblemType();
    expect($response)->toBeIn($pythonFilesList);
});
