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
        Schema::create('borongan_luar_pos', function (Blueprint $table) {
            $table->id();
            $table->string('Job_Order')->foreign()->references('id')->on('purchase_orders');
            $table->string('Nama_Item');
            $table->decimal('Quantity_Purchase_Order');
            $table->string('No_Cutting')->foreign()->references('id')->on('borongan_luar_items');
            $table->decimal('Anyam',20,2);
            $table->decimal('Ukir',20,2);
            $table->decimal('Handle',20,2);
            $table->decimal('Bubut',20,2);
            $table->decimal('Pirelly_Jok',20,2);
            $table->decimal('Sterofoam',20,2);
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
        Schema::dropIfExists('borongan_luar_pos');
    }
};
