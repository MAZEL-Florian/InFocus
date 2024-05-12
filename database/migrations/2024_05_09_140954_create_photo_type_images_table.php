<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoTypeImagesTable extends Migration
{
    public function up()
    {
        Schema::create('photo_type_images', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image_url');
            $table->string('camera_model');
            $table->string('aperture');
            $table->string('shutter_speed');
            $table->string('ISO');
            $table->string('focal_length');
            $table->foreignId('photo_type_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('photo_type_images');
    }
}
