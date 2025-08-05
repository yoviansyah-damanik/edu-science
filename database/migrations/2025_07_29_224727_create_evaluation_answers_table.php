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
        Schema::create('evaluation_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evaluation_id')
                ->references('id')
                ->on('evaluations')
                ->onDelete('cascade')
                ->onCascade('cascade');
            $table->foreignId('evaluation_question_id')
                ->references('id')
                ->on('evaluation_questions')
                ->onDelete('cascade')
                ->onCascade('cascade');
            $table->string('answer');
            $table->double('score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_answers');
    }
};
