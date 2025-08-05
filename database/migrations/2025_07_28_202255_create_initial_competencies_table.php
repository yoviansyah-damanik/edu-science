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
        Schema::create('initial_competencies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teaching_module_id')
                ->references('id')
                ->on('teaching_modules')
                ->onDelete('cascade')
                ->onCascade('cascade');
            $table->string('text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('initial_competencies');
    }
};
