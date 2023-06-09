<?php

use App\Http\Controllers\MathJaxController;
use Illuminate\Http\Request;

it('breaks a string with math within into an array of strings with data URIs', function () {
    // initialize variables
    $question = "Solve for $\\frac{dy}{dx}$ given: $ y = e^x $. Okay?";
    $request = new Request(['question' => $question]);
    $controller = new MathJaxController();

    // make the request
    $response = $controller->questionToParts($request);
    // assertions
    expect($response)->toBeArray();
});
