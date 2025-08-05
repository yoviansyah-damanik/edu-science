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
        Schema::create('files', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('filename');
            $table->string('filetype');
            $table->text('url');
            $table->morphs('fileable'); // This will create fileable_id and fileable_type columns
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
        Schema::dropIfExists('files');
    }
};
