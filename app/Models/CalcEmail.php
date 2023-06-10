<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalcEmail extends Model
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
}
