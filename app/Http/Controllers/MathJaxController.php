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
}
