<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borongan_luar_items', function (Blueprint $table) {
            $table->id();
            $table->string('Item_Id')->foreign()->references('id')->on('items');
            $table->decimal('Anyam');
            $table->decimal('Ukir');
            $table->decimal('Handle');
            $table->decimal('Bubut');
            $table->decimal('Pirelly_Jok');
            $table->decimal('Sterofoam');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('borongan_luar_items');
    }
};
