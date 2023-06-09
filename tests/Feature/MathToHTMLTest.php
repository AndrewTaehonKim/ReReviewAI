<?php

it('turns a sentence with math into html', function () {
    // initialize
    $stringEquation = "Solve for $\\frac{dy}{dx}$ given $ y=e^x-cos(x) $. Good?";
    $request = ['stringEquation' => $stringEquation];
    
    // get response
    $response = $this->post('/math-to-html', $request)->getContent();
    // assertion
    expect($response)->toBeString();
    expect($response)->toContain("Solve for");
    expect($response)->toContain("Good?");
    expect($response)->toContain("<img src=");

});
