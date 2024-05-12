<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacksTable extends Migration
{
    public function up()
    {
        Schema::create('packs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->text('advantages');
            $table->text('disadvantages');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('packs');
    }
}
