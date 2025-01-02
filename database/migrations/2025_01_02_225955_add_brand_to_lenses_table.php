<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lenses', function (Blueprint $table) {
            $table->string('brand')->nullable()->after('name');

           

            $table->string('max_focal_length')->nullable()->after('name');

            $table->decimal('min_aperture', 4, 1)->nullable()->after('max_focal_length');
            $table->decimal('max_aperture', 4, 1)->nullable()->after('min_aperture');
            $table->renameColumn('focal_length', 'min_focal_length');
        });
    }

    public function down(): void
    {
        Schema::table('lenses', function (Blueprint $table) {
            // Inverse des modifications
            $table->dropColumn('brand');
            $table->renameColumn('min_focal_length', 'focal_length');
            $table->dropColumn('max_focal_length');
            $table->dropColumn('min_aperture');
            $table->dropColumn('max_aperture');
        });
    }
};
