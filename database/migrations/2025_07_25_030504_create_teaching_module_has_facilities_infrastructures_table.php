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
        Schema::create('teaching_module_has_facilities_infrastructures', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('teaching_module_id');
            $table->unsignedBigInteger('facilities_infrastructure_id');
            $table->foreign('teaching_module_id', 'tm_fi_lp_id_fk')
                ->references('id')
                ->on('teaching_modules')
                ->onDelete('cascade')
                ->onCascade('cascade');
            $table->foreign('facilities_infrastructure_id', 'lp_fi_fi_id_fk')
                ->references('id')
                ->on('facilities_infrastructures')
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
        Schema::dropIfExists('teaching_module_has_facilities_infrastructures');
    }
};
