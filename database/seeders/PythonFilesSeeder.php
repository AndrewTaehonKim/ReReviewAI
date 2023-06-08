<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\PythonFile;


class PythonFilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
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
                        PythonFile::create([
                            'filename' => basename($filePath),
                            'filenameWithoutExtension' => pathinfo(basename($filePath), PATHINFO_FILENAME),
                            'path' => $filePath,
                            'subject' => basename($directory),
                        ]);
                    }
                    
                }
            }
        }
    }
}
