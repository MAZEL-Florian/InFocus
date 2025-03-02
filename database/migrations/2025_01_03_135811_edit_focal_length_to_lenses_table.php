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
        Schema::table('lenses', function (Blueprint $table) {
            $table->integer('max_focal_length')->change();
            $table->integer('min_focal_length')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lenses', function (Blueprint $table) {
            $table->string('max_focal_length')->change();
            $table->string('min_focal_length')->change();
        });
    }
};
