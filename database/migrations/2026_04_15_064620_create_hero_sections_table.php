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
    Schema::create('hero_sections', function (Blueprint $table) {
        $table->id(); // PK
        $table->string('badge')->nullable(); // badge
        $table->string('headline'); // headline
        $table->text('subheadline')->nullable(); // subheadline
        $table->string('cta_text')->nullable(); // cta_text
        $table->string('cta_link')->nullable(); // cta_link
        $table->string('image_url')->nullable(); // image_url
        $table->timestamps(); // created_at & updated_at
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_sections');
    }
};
