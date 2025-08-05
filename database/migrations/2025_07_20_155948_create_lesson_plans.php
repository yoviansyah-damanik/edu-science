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
        Schema::create('lesson_plans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('phase');
            $table->string('time_allocation');
            $table->string('subject');
            $table->string('subject_element');
            $table->string('class');
            $table->enum('semester', ['odd', 'even']);
            $table->year('year');
            $table->foreignUuid('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onCascade('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_plans');
    }
};
