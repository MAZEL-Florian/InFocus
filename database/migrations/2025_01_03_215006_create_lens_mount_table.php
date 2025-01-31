<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lens_mount', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lens_id');
            $table->unsignedBigInteger('mount_id');
            
            $table->unique(['lens_id', 'mount_id']);
            
            $table->timestamps();

            $table->foreign('lens_id')
                  ->references('id')
                  ->on('lenses')
                  ->onDelete('cascade');

            $table->foreign('mount_id')
                  ->references('id')
                  ->on('mounts')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lens_mount');
    }
};
