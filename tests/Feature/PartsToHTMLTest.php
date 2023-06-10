<?php

use App\Http\Controllers\MathJaxController;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

it('creates an html p tag with inserted image tags for math equations', function () {
    // initialize variables
    $controller = new MathJaxController();
    $request = ["Solve for ", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAhCAYAAADZPosTAAAACXBIWXMAAA7EAAAOxAGVKw4bAAACHUlEQVRIieXWTYiNYRQH8N81g/ExI5nBYAoLmcZXCtFgSsnngmYxkd0osrWifJRsJGVDipWFJKFkpTBWs5kIaZDMSklCyDQfFs+53XeuOx+ZyYJ/vd3nuec9/+ec85z+5+UvowKXcQfLxoIwh3XoRdVIHMYNY+/HInTg62gJF2AumtAW5GVYUuQ3PutUXoJomlS3DtRjG/ZL6Z/C1PA7GAc8x3a8KhVVDg9wJPYNEVk1NmEXzuB62JfjUxCXxMYgqI39PjyJg8rj9ymaw34Yd7MExTVcg5d4nzngIWrQh+lRhnsZe9tQhF/QFVHWYAse4UREV48P+IZKbMD9LEGuiLASN9Eu1WUmJkt1vRj/3UInFks9WoMew2BCZl2RWTdjDqbgtNQNf4wqdKMRq/EC84pfGvS6S+AnPkuNXY8DCpf3PyPfNptxbpRcN3B8lBz/InbiEo6N1GG4EfAYdZKojglyeIsdoyUqx3wsVNDBPGZJ4kBSowEzpVi+YCsOSenulUboirAdlZSoSVLyHkks1sZ7vw2pRlyRBOCjpOBdYVuPd7iK85IOXgvyvsFSvY8LmehfS4OJdDH5jNrROhhJHmX4jpbY18XJMxRqmIt1r6TYDKzvgJT7Jc17E/sWPJMuZ5WUYgNuS6OzU/oQaMXJbFRZwh/Yg6WYGAS1OIuV0kdAdURah91S03cPlXpVkMEkhRbJp5eLZ7bSXTK2+AXgWl3v8NAMrwAAAABJRU5ErkJggg==", " given: ", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACcAAAAQCAYAAACV3GYgAAAACXBIWXMAAA7EAAAOxAGVKw4bAAABi0lEQVRIie3UP0hVYRjH8c/V61VKDDLShKQiAiGRIIQgFTSqKUEamlqEhoIgB6eaGoLGNneHhgKrrQTFP4g6ldDoIAWllENRNF2H9zUPl+M9IngvQT94eOE5z/uc7/u8v3P4r0zlUIhrXTJZbTXhHk7iNy5gED9qq0kV1YHX6MYilrGCYjWhtlWIMYfjOLb9oCZRcKRCMDVos+OtJ7iDVsFmN5PFTRjDNHpjrgNTKY3rcSIjjpYBG8ALjMa1M0JdRTuu4a/V8hjBI0ziHGZwA+spzU9jKCVfTMRnjKfU9MT8eXzHQxwW/PUl1qwlN+TQjENYFca9gXd4g2fpA9iX3qIFE4KNPkbYXY2fxzdhrPMRrAGXhdGX6gyuZEB8xauSXE64whE8LwdUCgddwkngEn7hQ0r9BhYyev5MyRXxyc7Vw0VhEHNZkJ14jwcR8mXWhn2oH7O4j6d4LFxvWdXhunCKU1jC7QOAE99xNq570i3Bd/UYFn4h+bI7KqRabAqfdB8acRd/qgn1T2gLZ65FTnrClnQAAAAASUVORK5CYII=", ". Okay?"];
    
    // get response
    $response = $controller->partsToHTML($request);

    // assertion
    expect($response[0])->toBeString();
    expect($response[1])->toBeArray();
    

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
})->group('MathJaxControllerPrivate')->skip();

// change to public method for testing
