<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('models', function (Blueprint $table) {
            // On supprime les colonnes devenues inutiles :
            $table->dropColumn('camera_model');
            $table->dropColumn('aperture');
            $table->dropColumn('shutter_speed');
            $table->dropColumn('iso');
            $table->dropColumn('focal_length');

            // On ajoute ce qui est utile, par exemple 'brand':
            $table->string('brand')->nullable()->after('name');

            // Si vous souhaitez aussi renommer "models" en "cameras", par exemple :
            // Schema::rename('models', 'cameras');
            // --> Dans ce cas, ajustez dans le down() l’inverse, et adaptez votre code Eloquent.
        });
    }

    public function down(): void
    {
        Schema::table('models', function (Blueprint $table) {
            // Inverse des modifications :
            $table->string('camera_model')->after('name');
            $table->string('aperture')->after('camera_model');
            $table->string('shutter_speed')->after('aperture');
            $table->integer('iso')->after('shutter_speed');
            $table->string('focal_length')->after('iso');

            $table->dropColumn('brand');

            // Si vous aviez renommé la table en 'cameras' :
            // Schema::rename('cameras', 'models');
        });
    }
};
