<?php

use App\Http\Controllers\CalcProblemController;
use App\Models\CalcProblem;
use Database\Factories\CalcProblemFactory;

use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);
beforeEach(function () {
    $this->seed(); // Seed the database
});

it('saves all parts of the problem as html in the CalcHTML Database if it doesnt already exist', function () {
    // initialize
    $controller = new CalcProblemController();
    $problemData = CalcProblemFactory::new()->create();
    
    // get response
    $response = $controller->makeEmailData($problemData);
    $response2 = $controller->makeEmailData($problemData);
    // expectations
    expect($response)->toHaveKeys(
        [
        'question',
        'A',
        'B',
        'C',
        'D',
        'answer_letter',
        'answer',
        'difficulty',
        'tutorial_video',
        'collegeboard_unit',
        'tags',
        ]
    );
    expect($response2)->toHaveKeys(
        [
        'question',
        'A',
        'B',
        'C',
        'D',
        'answer_letter',
        'answer',
        'difficulty',
        'tutorial_video',
        'collegeboard_unit',
        'tags',
        ]
    );
    expect($response->question)->toBe($response2->question);
    expect($response->A)->toBe($response2->A);
    expect($response->B)->toBe($response2->B);
    expect($response->C)->toBe($response2->C);
    expect($response->D)->toBe($response2->D);
    expect($response->answer_letter)->toBe($response2->answer_letter);
    expect($response->answer)->toBe($response2->answer);
    expect($response->difficulty)->toBe($response2->difficulty);
    expect($response->tutorial_video)->toBe($response2->tutorial_video);
    expect($response->collegeboard_unit)->toBe($response2->collegeboard_unit);
    expect($response->tags)->toBe($response2->tags);

    // remove saved files
    $directory = 'images/calc';
    // Get all files in the directory
    $files = Storage::allFiles($directory);
    // Set the threshold date for deletion (e.g., delete files older than 7 days)
    $thresholdDate = Carbon::now()->subMinutes(10);
    // Delete files newer than the threshold date
    foreach ($files as $file) {
        $lastModified = Storage::lastModified($file);
        $lastModifiedDate = Carbon::createFromTimestamp($lastModified);
        if ($lastModifiedDate->greaterThanOrEqualTo($thresholdDate)) {
            Storage::delete($file);
        }
    }
});
