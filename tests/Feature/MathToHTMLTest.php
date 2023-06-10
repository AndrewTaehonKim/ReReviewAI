<?php

use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

it('turns a sentence with math into html', function () {
    // initialize
    $stringEquation = "Solve for $\\frac{dy}{dx}$ given $ y=e^x-cos(x) $. Good?";
    $request = ['stringEquation' => $stringEquation];
    // get response
    $response = $this->post('/math-to-html', $request)->getContent();
    $html = json_decode($response)[0];
    $paths = json_decode($response)[1];
    // assertion
    expect($html)->toBeString();
    expect($html)->toContain("Solve for");
    expect($html)->toContain("Good?");
    expect($html)->toContain("<img src=");
    expect($paths)->toBeArray();

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
