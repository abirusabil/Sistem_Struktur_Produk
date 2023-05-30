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
        Schema::create('kebutuhan_komponen_finishing_pos', function (Blueprint $table) {
            $table->id();
            $table->string('Job_Order')->foreign()->references('id')->on('purchase_orders');
            $table->string('Nama_Item');
            $table->decimal('Quantity_Purchase_Order');
            $table->string('No_Cutting')->foreign()->references('id')->on('kebutuhan_komponen_finishing_items');
            $table->string('Komponen_Finishing_Id')->foreign()->references('id')->on('master_komponen_finishings');
            $table->string('Nama_Komponen_Finishing');
            $table->decimal('Quantity_Kebutuhan_Komponen_Finishing_Item');
            $table->decimal('Quantity_Komponen_Finishing');
            $table->string('Satuan_Komponen_Finishing');
            $table->decimal('Harga_Komponen_Finishing',20,2);
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
        Schema::dropIfExists('kebutuhan_komponen_finishing_pos');
    }
};
