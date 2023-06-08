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
        Schema::create('python_files', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('filename');
            $table->string('filenameWithoutExtension');
            $table->string('path');
            $table->string('subject');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('python_files');
    }
};
