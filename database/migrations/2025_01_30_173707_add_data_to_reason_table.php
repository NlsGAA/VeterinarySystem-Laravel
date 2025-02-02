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
        DB::table('reason_type')->insert([
            ['id' => 1, 'description' => 'Serviços Gerais'],
            ['id' => 2, 'description' => 'Internamento'],
            ['id' => 3, 'description' => 'Consulta']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('reason_type')->truncate();
    }
};
