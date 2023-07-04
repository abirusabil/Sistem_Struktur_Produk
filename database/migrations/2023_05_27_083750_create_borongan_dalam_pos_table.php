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
        Schema::create('borongan_dalam_pos', function (Blueprint $table) {
            $table->id();
            $table->string('Job_Order')->foreign()->references('id')->on('purchase_orders');
            $table->string('Item_Id')->foreign()->references('id')->on('items');
            $table->string('Nama_Item');
            $table->decimal('Quantity_Purchase_Order');
            $table->string('No_Cutting')->foreign()->references('id')->on('borongan_dalam_items');
            $table->decimal('Bahan_1',20,2);
            $table->decimal('Bahan_2',20,2);
            $table->decimal('Sanding_1',20,2);
            $table->decimal('Sanding_2',20,2);
            $table->decimal('Proses_Assembling',20,2);
            $table->decimal('Finishing',20,2);
            $table->decimal('Packing',20,2);
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
        Schema::dropIfExists('borongan_dalam_pos');
    }
};
