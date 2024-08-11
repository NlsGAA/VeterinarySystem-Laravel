<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('hospitalized_situation')->insert([
            ['situation_id' => 1, 'name' => 'Urgência'],
            ['situation_id' => 2, 'name' => 'Clínica'],
            ['situation_id' => 3, 'name' => 'Cirúgico'],
            ['situation_id' => 4, 'name' => 'Terapêutico'],
            ['situation_id' => 5, 'name' => 'Observação'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hospitalized_situation', function (Blueprint $table) {
            //
        });
    }
};
