<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('calcHTML', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            
            // contains html strings
            $table->string('question');
            $table->string('A');
            $table->string('B');
            $table->string('C');
            $table->string('D');
            $table->string('answer');
            
            // connection to CalcProblem Database
            $table->foreignId('calc_problem_id')->nullable()->constrained('calc_problems');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calcHTML');
    }
};
