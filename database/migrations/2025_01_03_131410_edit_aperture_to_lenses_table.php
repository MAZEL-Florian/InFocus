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
            $table->string('min_aperture')->change();
            $table->string('max_aperture')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lenses', function (Blueprint $table) {
            $table->decimal('min_aperture', 4, 1)->nullable()->change();
            $table->decimal('max_aperture', 4, 1)->nullable()->change();
        });
    }
};
