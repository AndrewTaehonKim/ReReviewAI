<?php

use App\Http\Controllers\MathJaxController;
use Illuminate\Http\Request;

it('has mathtoimage page', function () {
    $controller = new MathJaxController();
    $request = new Request(['equation' => 'here is the equation: $a^2 + b^2 = c^2$']);
    $response = $controller->mathToDataURI($request);

    expect($response)->toContain('data:image/png;base64,');
});
