<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalcImage extends Model
{
    use HasFactory;

    protected $table = 'calcImages';

    protected $fillable = [
        'question',
        'A',
        'B',
        'C',
        'D',
        'answer',
    ];

    /* Relationships */
    public function calcProblem()
    {
        return $this->belongsTo(CalcProblem::class);
    }
}
