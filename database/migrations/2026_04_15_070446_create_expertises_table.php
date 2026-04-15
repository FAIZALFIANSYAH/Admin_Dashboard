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
    Schema::create('expertises', function (Blueprint $table) {
        $table->id(); // PK [cite: 16]
        // Menghubungkan ke about_sections.id [cite: 17]
        $table->foreignId('about_id')->constrained('about_sections')->onDelete('cascade');
        $table->string('name'); // name [cite: 18]
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expertises');
    }
};
