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
    Schema::create('videos', function (Blueprint $table) {
        $table->id();
        $table->string('title')->nullable(); // Judul video (opsional)
        $table->string('video_url'); // Path/URL ke file .mp4
        $table->string('thumbnail_url')->nullable(); // Cover video sebelum diputar
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
