<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PythonFile extends Model
{
    use HasFactory;

    protected $table = 'python_files';

    protected $fillable = [
        'filename',
        'path',
        'subject'
    ];

    /* Relationships */
    public function calcProblems()
    {
        return $this->hasMany(CalcProblem::class)->withTimestamps();;
    }
}
