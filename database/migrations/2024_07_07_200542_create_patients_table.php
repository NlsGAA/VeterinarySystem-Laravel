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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('raca');
            $table->string('especie');
            $table->double('peso');
            $table->boolean('tipoPeso');
            $table->string('coloracao');
            $table->integer('idade');
            $table->boolean('tipoIdade');
            $table->string('procedencia');
            $table->string('motivoCadastro');
            $table->foreignId('user_id')->constrained();
            $table->string('image')->nullable();
            $table->foreignId('owner_id')->constrained('owners_data','id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
