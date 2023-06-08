<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PythonFile;
use Illuminate\Support\Facades\Storage;

class UpdatePythonFilesDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'python-database:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the python files database with all of the python files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $excludedDirectories = ['__pycache__'];
        $excludedFiles = ['main_functions.py'];

        $directories = Storage::disk('local')->directories('python');

        foreach ($directories as $directory) {
            // Check if the directory is excluded
            if (in_array(basename($directory), $excludedDirectories)) {
                continue;
            }
            else {
                $pythonFiles = Storage::disk('local')->files($directory);
                foreach ($pythonFiles as $filePath) {
                    // check if the file is excluded
                    if (in_array(basename($filePath), $excludedFiles)) {
                        continue;
                    }
                    else {
                        // Update or create a PythonFile record based on the filename
                        PythonFile::updateOrCreate([
                            'filename' => basename($filePath),
                            'filenameWithoutExtension' => pathinfo(basename($filePath), PATHINFO_FILENAME),
                            'path' => $filePath,
                            'subject' => basename($directory),
                        ]);
                    }
                    
                }
            }
        }
        $this->info('Python files database updated successfully.');
    }
}
