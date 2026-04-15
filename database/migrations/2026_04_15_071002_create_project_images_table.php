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
    Schema::create('project_images', function (Blueprint $table) {
        $table->id(); // PK [cite: 44]
        // Menghubungkan ke projects.id [cite: 45]
        $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
        $table->string('image_url'); // image_url [cite: 46]
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_images');
    }
};
