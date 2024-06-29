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
        Schema::create('register_users', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('sobrenome', 100);
            $table->string('cpf', 15);
            $table->date('dataNascimento');
            $table->string('telefone');
            $table->string('email');
            $table->string('senha');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('register_users');
    }
};
