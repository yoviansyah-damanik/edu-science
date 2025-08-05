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
        Schema::create('student_worksheets', function (Blueprint $table) {
            $table->id();
            $table->string('basic_competency');
            $table->string('objective');
            $table->text('basic_skill');
            $table->text('ability_basic');
            $table->text('ability_intermediate');
            $table->text('ability_advanced');
            $table->text('style_visual');
            $table->text('style_audio');
            $table->text('style_kinesthetic');
            $table->text('interest_technique');
            $table->text('interest_adventure');
            $table->text('interest_household');
            $table->text('question_lv_1');
            $table->text('question_lv_2');
            $table->text('question_lv_3');
            $table->text('evaluation_basic');
            $table->text('evaluation_intermediate');
            $table->text('evaluation_advanced');
            $table->text('project');
            $table->text('reflection_basic');
            $table->text('reflection_intermediate');
            $table->text('reflection_advanced');
            $table->text('answer_key');
            $table->text('assessment_section');
            $table->foreignId('lesson_material_id')
                ->references('id')
                ->on('lesson_materials')
                ->onDelete('cascade')
                ->onCascade('cascade');
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
        Schema::dropIfExists('student_worksheets');
    }
};
