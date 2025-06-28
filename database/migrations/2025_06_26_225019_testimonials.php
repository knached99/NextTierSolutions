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
        Schema::create('testimonials', function(Blueprint $table){

            $table->uuid('testimonialID')->primary();
            $table->string('name');
            $table->string('position');
            $table->string('company_name');
            $table->text('testimonial_content');
            $table->text('testimonial_submitter_picture')->nullable();
            $table->text('company_logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
