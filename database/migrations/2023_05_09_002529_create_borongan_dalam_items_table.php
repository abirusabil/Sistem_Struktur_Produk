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
        Schema::create('borongan_dalam_items', function (Blueprint $table) {
            $table->id();
            $table->string('Item_Id')->foreign()->references('id')->on('items');
            $table->decimal('Bahan_1');
            $table->decimal('Bahan_2');
            $table->decimal('Sanding_1');
            $table->decimal('Sanding_2');
            $table->decimal('Proses_Assembling');
            $table->decimal('Finishing');
            $table->decimal('Packing');
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
        Schema::dropIfExists('borongan_dalam_items');
    }
};
