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
        Schema::create('lesson_activities', function (Blueprint $table) {
            $table->id();
            $table->text('introduction');
            $table->text('core');
            $table->text('closing');
            $table->integer('introduction_time');
            $table->integer('core_time');
            $table->integer('closing_time');
            $table->foreignId('lesson_material_id')
                ->references('id')
                ->on('lesson_materials')
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
        Schema::dropIfExists('lesson_activities');
    }
};
