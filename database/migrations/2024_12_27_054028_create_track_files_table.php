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
        Schema::create('track_files', function (Blueprint $table) {
            $table->id();
            $table->string('filepath')->nullable();
            $table->foreignId('file_upload_id')->constrained()->nullable();
            $table->bigInteger('expires_at')->nullable();
            $table->string('password')->nullable();
            $table->tinyInteger('is_premium')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('track_files');
    }
};
