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
        Schema::create('home_contents', function (Blueprint $table) {
            $table->id();
            $table->string('section');
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->json('content')->nullable();
            $table->string('image')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_link')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
            
            // Index for faster lookups by section
            $table->index('section');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_contents');
    }
}; 