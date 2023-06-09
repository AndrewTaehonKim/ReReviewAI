<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class MathJaxController extends Controller
{
    private function mathToDataURI($equation)
    {
        // Use MathJax-node to convert the equation to an image
        $jsScriptPath = base_path('resources\js\mathToImage.js');
        $process = new Process(['node', $jsScriptPath, $equation]);
        $process->setTimeout(60);
        try {
            $process->mustRun();
            $png = $process->getOutput();
            return $png;
        } catch (ProcessFailedException $exception) {
            // Handle the exception or log the error
            return null;
        }
    }

    // converts a question string with delimiters ($ $) into an array of strings and data uris in order for later compilation
    private function questionToParts($question)
    {
        $delimiter = '$';
        $maths = [];
        $allParts = explode($delimiter, $question);
        $pattern = '/\$(.*?)\$/';
        preg_match_all($pattern, $question, $maths);
        
        // this will store all the parts as either a string or datauri string
        $finalArray = [];

        // loop through all the parts of the string
        foreach ($allParts as $part) {
            // if this is a part is math
            if (in_array($part, $maths[1])) {
                $request = new Request(['equation' => $part]);
                $item = $this->mathToDataURI($request);
            }
            else {
                $item = $part;
            }
            array_push($finalArray, $item);
        }
        return $finalArray;
    }

    // converts an array of strings and data uris to html
    private function partsToHTML($parts)
    {
        $htmlCode = "<p>";
        $datauri = 'data:image/png';
        foreach ($parts as $part) {
            if (strpos($part, $datauri) !== false){
                $path = $this->convertToImage($part);
                $htmlCode.= '<img src="'. $path. '">';
            }
            else {
                $htmlCode.= $part;
            }
        }
        $htmlCode.= '</p>';
        return ($htmlCode);
    }

    // converts a data URI into an image and returns the temporary path
    private function convertToImage($dataURI)
    {
        $parts = explode(',', $dataURI);
        $base64Data = $parts[1];
        // Decode the base64-encoded data
        $imageData = base64_decode($base64Data);

        // Create an Intervention Image instance from the binary data
        $image = Image::make($imageData);

        // Save the image as a temporary PNG file
        $imageName = uniqid('image_');
        $imagePath = Storage::disk('local')->path('images/calc/' . $imageName.'.png');
        $image->save($imagePath);

        return $imagePath;
    }

    // puts all of the above functions together by converting a string into html with embedded images
    public function mathToHTML(Request $request)
    {
        $stringEquation = $request->input('stringEquation');
        $array = $this->questionToParts($stringEquation);
        $html = $this->partsToHTML($array);
        return $html;
    }
}
