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
        Schema::create('lesson_reflections', function (Blueprint $table) {
            $table->id();
            $table->text('teacher_reflection');
            $table->text('student_reflection');
            $table->foreignUuid('lesson_plan_id')
                ->references('id')
                ->on('lesson_plans')
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
        Schema::dropIfExists('lesson_reflections');
    }
};
