<?php

use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

it('turns a sentence with math into html', function () {
    // initialize
    $stringEquation = "Solve for $\\frac{dy}{dx}$ given $ y=e^x-cos(x) $. Good?";
    $request = ['stringEquation' => $stringEquation];
    // get response
    $response = $this->post('/math-to-image', $request)->getContent();
    $path = $response;

    // assertion
    expect($path)->toBeString();
    expect($path)->toContain('app/images/calc/');
    expect($path)->toContain('.png');

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
