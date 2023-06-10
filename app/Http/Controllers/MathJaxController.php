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

    // converts a question string with delimiters ($ $) into a datauri
    private function questionReformat($question)
    {
        $delimiter = '$';
        $maths = [];
        $allParts = explode($delimiter, $question);
        $pattern = '/\$(.*?)\$/';
        preg_match_all($pattern, $question, $maths);
        
        // this will store all the parts as either a string or datauri string
        $finalString = '';

        // loop through all the parts of the string
        foreach ($allParts as $part) {
            // if this is a part is math
            if (in_array($part, $maths[1])) {
                $finalString .= $part;
            }
            else {
                $finalString .= '\text{'.$part.'}';
            }
        }
        $dataURI = $this->mathToDataURI($finalString);

        return $dataURI;
    }

    // // converts an array of strings and data uris to html
    // public function partsToHTML($parts)
    // {
    //     $htmlCode = '<p style="color: red">';
    //     $datauri = 'data:image/png';
    //     $paths = [];
    //     foreach ($parts as $part) {
    //         if (strpos($part, $datauri) !== false){
    //             $path = $this->convertToImage($part);
    //             array_push($paths, $path);
    //             $htmlCode.= '<img src="{{ $message->embed(storage_path(\''.$path.'\'))}}">';
    //         }
    //         else {
    //             $htmlCode.= $part;
    //         }
    //     }
    //     $htmlCode.= '</p>';
    //     return [$htmlCode, $paths];
    // }

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
        $imagePath = 'app/images/calc/' . $imageName.'.png';
        return $imagePath;
    }

    // puts all of the above functions together by converting a string into html with embedded images
    public function mathToImage(Request $request)
    {
        $stringEquation = $request->input('stringEquation');
        $dataURI = $this->questionReformat($stringEquation);
        $path = $this->convertToImage($dataURI);
        return $path;
    }
}
