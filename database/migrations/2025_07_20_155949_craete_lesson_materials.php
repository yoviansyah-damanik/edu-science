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
        Schema::create('lesson_materials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('summary');
            $table->text('content');
            $table->text('youtube_url')
                ->nullable();
            $table->foreignUuid('lesson_plan_id')
                ->references('id')
                ->on('lesson_plans')
                ->onDelete('cascade')
                ->onCascade('cascade');
            $table->foreignId('lesson_material_category_id')
                ->references('id')
                ->on('lesson_material_categories')
                ->onDelete('cascade')
                ->onCascade('cascade');
            $table->foreignUuid('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onCascade('cascade');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_materials');
    }
};
