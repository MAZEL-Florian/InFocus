<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackProductsTable extends Migration
{
    public function up()
    {
        Schema::create('pack_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pack_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pack_products');
    }
}
