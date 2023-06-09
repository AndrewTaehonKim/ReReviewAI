<?php

use App\Http\Controllers\MathJaxController;

it('changes math to a data uri', function () {
    $controller = new MathJaxController();
    $request = "a^2 + b^2 = c^2";
    $response = $controller->mathToDataURI($request);

    expect($response)->toContain('data:image/png;base64,');
})->group('MathJaxControllerPrivate')->skip();

// change to public method for testing