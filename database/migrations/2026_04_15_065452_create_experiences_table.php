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
    Schema::create('experiences', function (Blueprint $table) {
        $table->id(); // id (PK) [cite: 25]
        $table->string('position'); // position [cite: 26]
        $table->string('company_name'); // company_name [cite: 27]
        $table->string('location')->nullable(); // location [cite: 28]
        $table->string('start_year'); // start_year [cite: 29]
        $table->string('end_year')->nullable(); // end_year [cite: 30]
        $table->boolean('is_current')->default(false); // is_current [cite: 31]
        $table->text('description')->nullable(); // description [cite: 32]
        $table->timestamps(); // created_at [cite: 33]
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
