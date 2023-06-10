<?php

use App\Http\Controllers\MathJaxController;

it('breaks a string with math within into an array of strings with data URIs', function () {
    // initialize variables
    $question = "Solve for $\\frac{dy}{dx}$ given: $ y = e^x $. Okay?";
    $controller = new MathJaxController();

    // make the request
    $response = $controller->questionReformat($question);
    // assertions
    expect($response)->toBeString();
})->group('MathJaxControllerPrivate')->skip();

// change to public method for testing

