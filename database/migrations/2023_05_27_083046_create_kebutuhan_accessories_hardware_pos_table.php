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
        Schema::create('kebutuhan_accessories_hardware_pos', function (Blueprint $table) {
            $table->id();
            $table->string('Job_Order')->foreign()->references('id')->on('purchase_orders');
            $table->string('Nama_Item');
            $table->decimal('Quantity_Purchase_Order');
            $table->string('No_Cutting')->foreign()->references('id')->on('kebutuhan_accessories_hardware_items');
            $table->string('Accessories_Hardware_Id')->foreign()->references('id')->on('master_accessories_hardware');
            $table->string('Nama_Accessories_Hardware');
            $table->string('Keterangan_Kebutuhan_Accessories_Hardware_Item');
            $table->string('Ukuran_Accessories_Hardware');
            $table->decimal('Quantity_Kebutuhan_Accessories_Hardware_Item');
            $table->string('Satuan_Accessories_Hardware');
            $table->decimal('Harga_Accessories_Hardware',20,2);
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
        Schema::dropIfExists('kebutuhan_accessories_hardware_pos');
    }
};
