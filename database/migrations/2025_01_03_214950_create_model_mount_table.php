<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('model_mount', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('model_id');
            $table->unsignedBigInteger('mount_id');
            
            // index pour la performance
            $table->unique(['model_id', 'mount_id']);
            
            $table->timestamps();

            $table->foreign('model_id')
                  ->references('id')
                  ->on('models')
                  ->onDelete('cascade');

            $table->foreign('mount_id')
                  ->references('id')
                  ->on('mounts')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('model_mount');
    }
};
