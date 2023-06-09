<?php

namespace App\Http\Controllers;

use App\Models\CalcProblem;
use App\Models\PythonFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class CalcProblemController extends Controller
{
    // Generates the Problems based on the type 
    public function makeProblem(Request $request)
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

    public function store(CalcProblem $problem)
    {
        // Save the model to the database
        $problem->save();
        // Get ID
        $id = $problem->id;
        // redirect with success message
        return $id;
    }

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

    public function makeStore(Request $request)
    {
        $problem = $this->makeProblem($request);

        $id = $this->store($problem);
        return $id;
    }

    public function makeStoreShow(Request $request)
    {
        $id = $this->makeStore($request);
        $view = $this->showProblem($id);
        return $view;
    }

    public function getUniqueProblem(Request $request)
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
                $id = $this->makeStoreShow($request);
            }
        }
        // For Guests
        else if (Auth::guest()) {
            $randomProblem = CalcProblem::inRandomOrder()->first();
            $id = $randomProblem->id;
        }
        return $id;
    }

    /* ------ RUN AND GET OUTPUT OF PYTHON SCRIPT --------*/
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