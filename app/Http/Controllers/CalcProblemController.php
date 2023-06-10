<?php

namespace App\Http\Controllers;

use App\Models\CalcEmail;
use App\Models\CalcImage;
use App\Models\CalcProblem;
use App\Models\PythonFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class CalcProblemController extends Controller
{
    public function showProblem($id)
    {
        // Retrieve the calc problem from the database based on the ID
        $calcProblem = CalcProblem::findOrFail($id);

        // Retrieve the authenticated user
        if (Auth::check()) {
            $user = auth()->user();
            // Mark the calc problem as seen for the user
            $user->calcProblems()->syncWithoutDetaching([$calcProblem->id => [
                'is_seen' => true, 
                'last_seen_at' => now()
                ]]);
        }
        // Display the calc problem using a view
        return view('calcProblem.index', compact('calcProblem'));
    }

    public function makeStoreShow(Request $request)
    {
        $id = $this->makeStore($request);
        $view = $this->showProblem($id);
        return $view;
    }
    
    public function getUniqueProblem(Request $request) // the request is ['type'=> 'problem_type']
    {
        $id = 0; // initialize problem id
        // For Authorized User
        if (Auth::user()) {
            // Retrieve the authenticated user
            $user = auth()->user();
            // Mark the calc problem as seen for the user
            $problem = CalcProblem::whereDoesntHave('users', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->inRandomOrder()->first();
            // If there is a problem the user has not yet seen
            if ($problem) {
                $user->calcProblems()->syncWithoutDetaching([$problem->id => [
                    'is_seen' => true, 
                    'last_seen_at' => now()
                    ]]);
                $id = $problem->id;
            }       
            // If the user has seen all the problems -> make a new problem
            else {
                // make problem
                $id = $this->makeStore($request);
            }
        }
        // For Guests
        else if (Auth::guest()) {
            $randomProblem = CalcProblem::inRandomOrder()->first();
            if ($randomProblem) {
                $id = $randomProblem->id;
            }
            else {
                $id = $this->makeStore($request);
            }
        }
        return $id;
    }

    // saves all parts of the problem as html in the CalcImage Database if it doesn't already exist and returns a
    public function makeEmailData(CalcProblem $calcProblem)
    {
        $calcEmail = new CalcEmail();
        // if code and images already exist in the database
        if($calcProblem->CalcImage()->exists()) {
            // get html stuff directly
            $calcEmail->question = $calcProblem->CalcImage->question;
            $calcEmail->A = $calcProblem->CalcImage->A;
            $calcEmail->B = $calcProblem->CalcImage->B;
            $calcEmail->C = $calcProblem->CalcImage->C;
            $calcEmail->D = $calcProblem->CalcImage->D;
            $calcEmail->answer = $calcProblem->CalcImage->answer;
        }
        else {
            // get the html
            $CalcImage = new CalcImage();
            $controller = new MathJaxController();
            $question = $controller->mathToImage(new Request(['stringEquation' => $calcProblem->question]));
            $A = $controller->mathToImage(new Request(['stringEquation' => $calcProblem->A]));
            $B = $controller->mathToImage(new Request(['stringEquation' => $calcProblem->B]));
            $C = $controller->mathToImage(new Request(['stringEquation' => $calcProblem->C]));
            $D = $controller->mathToImage(new Request(['stringEquation' => $calcProblem->D]));
            $answer = $controller->mathToImage(new Request(['stringEquation' => $calcProblem->answer]));
            
            // save html to the CalcImage database
            $CalcImage->question = $question;
            $CalcImage->A = $A;
            $CalcImage->B = $B;
            $CalcImage->C = $C;
            $CalcImage->D = $D;
            $CalcImage->answer = $answer;

            $calcProblem->CalcImage()->save($CalcImage);

            // set calcEmail to data
            $calcEmail->question = $question;
            $calcEmail->A = $A;
            $calcEmail->B = $B;
            $calcEmail->C = $C;
            $calcEmail->D = $D;
            $calcEmail->answer = $answer;
        }

        // fill out the rest of the data
        $calcEmail->answer_letter = $calcProblem->answer_letter;
        $calcEmail->difficulty = $calcProblem->difficulty;
        $calcEmail->tutorial_video = $calcProblem->tutorial_video;
        $calcEmail->collegeboard_unit = $calcProblem->collegeboard_unit;
        $calcEmail->tags = $calcProblem->tags;

        return $calcEmail;
    }

    /* Private Functions */

    // Generates the Problems based on the type 
    private function makeProblem(Request $request)
    {
        $filename = $request->input('type');
        $problemData = $this->runPythonScript($filename);

        // Fill out data for Calc Problem
        $problem = new CalcProblem();
        $problem->fill($problemData);
        // Connect Calc Problem to python file
        $pythonFile = PythonFile::where('filename', $filename.'.py')->first();
        if($pythonFile){
            $problem->python_file_id = $pythonFile->id;
        }
        return $problem;
    }

    private function store(CalcProblem $problem)
    {
        // Save the model to the database
        $problem->save();
        // Get ID
        $id = $problem->id;
        // redirect with success message
        return $id;
    }

    private function makeStore(Request $request)
    {
        $problem = $this->makeProblem($request);

        $id = $this->store($problem);
        return $id;
    }

    private function runPythonScript($filename)
    {
        $pythonScriptPath = storage_path('app/python/calcBC/'.$filename.'.py');
        $process = new Process(['python', $pythonScriptPath], env: [
            'SYSTEMROOT' => getenv('SYSTEMROOT'),
            'PATH' => getenv("PATH")
    ]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        
        // get output from python print function
        $output = $process->getOutput();

        // Parse the JSON output
        $data = json_decode($output, true);
        
        // Return a response
        return $data;
    }
}