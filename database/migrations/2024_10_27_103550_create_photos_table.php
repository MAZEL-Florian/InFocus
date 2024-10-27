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
            $table->string('make');
            $table->string('exposure_time');
            $table->integer('iso');
            $table->string('focal_length');
            $table->unsignedBigInteger('model_id');
            $table->foreign('model_id')->references('id')->on('models')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('lens_id');
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
