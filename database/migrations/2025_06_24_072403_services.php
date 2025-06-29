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
    Schema::create('services', function (Blueprint $table) {
    $table->uuid('serviceID')->primary();
    $table->string('title');
    $table->text('description')->nullable();
    $table->string('icon_class')->nullable(); // e.g. "bi bi-briefcase"
    $table->string('icon_color')->nullable(); // e.g. "#f57813"
    $table->integer('order')->default(0);
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
