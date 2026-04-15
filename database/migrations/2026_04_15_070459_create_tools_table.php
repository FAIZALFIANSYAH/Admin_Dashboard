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
    Schema::create('tools', function (Blueprint $table) {
        $table->id(); // PK [cite: 20]
        // Menghubungkan ke about_sections.id [cite: 21]
        $table->foreignId('about_id')->constrained('about_sections')->onDelete('cascade');
        $table->string('name'); // name [cite: 22]
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tools');
    }
};
