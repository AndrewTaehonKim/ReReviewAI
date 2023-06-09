<?php

use App\Http\Controllers\MathJaxController;

it('converts a datauri into a temporary image', function () {
    // initialize variables
    $datauri = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACcAAAAQCAYAAACV3GYgAAAACXBIWXMAAA7EAAAOxAGVKw4bAAABi0lEQVRIie3UP0hVYRjH8c/V61VKDDLShKQiAiGRIIQgFTSqKUEamlqEhoIgB6eaGoLGNneHhgKrrQTFP4g6ldDoIAWllENRNF2H9zUPl+M9IngvQT94eOE5z/uc7/u8v3P4r0zlUIhrXTJZbTXhHk7iNy5gED9qq0kV1YHX6MYilrGCYjWhtlWIMYfjOLb9oCZRcKRCMDVos+OtJ7iDVsFmN5PFTRjDNHpjrgNTKY3rcSIjjpYBG8ALjMa1M0JdRTuu4a/V8hjBI0ziHGZwA+spzU9jKCVfTMRnjKfU9MT8eXzHQxwW/PUl1qwlN+TQjENYFca9gXd4g2fpA9iX3qIFE4KNPkbYXY2fxzdhrPMRrAGXhdGX6gyuZEB8xauSXE64whE8LwdUCgddwkngEn7hQ0r9BhYyev5MyRXxyc7Vw0VhEHNZkJ14jwcR8mXWhn2oH7O4j6d4LFxvWdXhunCKU1jC7QOAE99xNq570i3Bd/UYFn4h+bI7KqRabAqfdB8acRd/qgn1T2gLZ65FTnrClnQAAAAASUVORK5CYII=";
    $controller = new MathJaxController();

    // make the request
    $response = $controller->convertToImage($datauri);
    // assertions
    expect($response)->toBeString();
})->group('MathJaxControllerPrivate')->skip();

// change to public method for testing
