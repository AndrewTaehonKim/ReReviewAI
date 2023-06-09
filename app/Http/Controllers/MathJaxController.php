<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Mathjax\Mathjax;

class MathJaxController extends Controller
{
    public function mathToDataURI(Request $request)
    {
        // Get the equation from the request or fetch it from your table
        $equation = $request->input('equation');
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
    public function questionToParts(Request $request)
    {
        $question = $request->input('question');
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
}
