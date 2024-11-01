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
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->char('uuid', 36)->unique();
            $table->string('image_url');
            $table->string('make')->nullable();
            $table->string('exposure_time')->nullable();
            $table->integer('iso')->nullable();
            $table->string('focal_length')->nullable();
            $table->unsignedBigInteger('model_id')->nullable();
            $table->foreign('model_id')->references('id')->on('models')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('lens_id')->nullable();
            $table->foreign('lens_id')->references('id')->on('lenses')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
