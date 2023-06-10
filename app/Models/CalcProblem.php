<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalcProblem extends Model
{
    use HasFactory;
    protected $fillable = [
        'question',
        'A',
        'B',
        'C',
        'D',
        'answer_letter',
        'answer',
        'difficulty',
        'tutorial_video',
        'collegeboard_unit',
        'tags',
    ];

    /* Relationships */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_calcProblem')
            ->withPivot('is_seen', 'is_mastered','is_prioritized','last_seen_at')
            ->withTimestamps();
    }

    public function pythonFiles()
    {
        return $this->belongsTo(PythonFile::class, 'calc_problem_python_file')
            ->withTimestamps();
    }

    public function calcHTML()
    {
        return $this->hasOne(CalcHTML::class);
    }
}
