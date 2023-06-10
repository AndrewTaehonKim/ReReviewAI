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
        Schema::rename('calcHTML', 'calcImages');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calcHTML', function (Blueprint $table) {
            //
        });
    }
};
