<?php

use App\Http\Controllers\MathJaxController;
use Illuminate\Http\Request;

it('breaks a string with math within into an array of strings with data URIs', function () {
    // initialize variables
    $question = "Solve for $\\frac{dy}{dx}$ given: $ y = e^x $. Okay?";
    $controller = new MathJaxController();

    // make the request
    $response = $controller->questionToParts($question);
    // assertions
    expect($response)->toBeArray();
})->group('MathJaxControllerPrivate')->skip();

// change to public method for testing

