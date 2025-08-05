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
        Schema::create('learning_activities', function (Blueprint $table) {
            $table->id();
            $table->text('introduction');
            $table->integer('introduction_minute');
            $table->text('core');
            $table->integer('core_minute');
            $table->text('closing');
            $table->integer('closing_minute');
            $table->foreignId('student_worksheet_id')
                ->references('id')
                ->on('student_worksheets')
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
        Schema::dropIfExists('learning_activities');
    }
};
