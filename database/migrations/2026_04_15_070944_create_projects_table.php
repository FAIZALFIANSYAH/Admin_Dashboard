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
    Schema::create('projects', function (Blueprint $table) {
        $table->id(); // PK [cite: 35]
        $table->string('title'); // title [cite: 36]
        $table->string('slug')->unique(); // slug [cite: 37]
        $table->string('category'); // category [cite: 38]
        $table->string('year'); // year [cite: 39]
        $table->string('thumbnail'); // thumbnail [cite: 40]
        $table->text('description'); // description [cite: 41]
        $table->timestamps(); // created_at [cite: 42]
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
