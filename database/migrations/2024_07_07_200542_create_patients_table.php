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
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('breed');
            $table->string('species');
            $table->double('weight');
            $table->boolean('weight_type');
            $table->string('color');
            $table->integer('age');
            $table->boolean('age_type');
            $table->string('origin');
            $table->string('reason');
            $table->foreignId('user_id')->constrained();
            $table->string('image')->nullable();
            $table->foreignId('owner_id')->constrained('owners_data','id')->onDelete('cascade');
            $table->dateTime('deleted_at')->nullable();
            $table->string('updated_by')->nullable();
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
