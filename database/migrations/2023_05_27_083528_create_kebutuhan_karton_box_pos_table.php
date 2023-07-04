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
        Schema::create('kebutuhan_karton_box_pos', function (Blueprint $table) {
            $table->id();
            $table->string('Job_Order')->foreign()->references('id')->on('purchase_orders');
            $table->string('Item_Id')->foreign()->references('id')->on('items');
            $table->string('Nama_Item');
            $table->decimal('Quantity_Purchase_Order');
            $table->string('No_Cutting')->foreign()->references('id')->on('kebutuhan_karton_box_items');
            $table->string('Jenis_Kebutuhan_Karton_Box');
            $table->string('Keterangan_Kebutuhan_Karton_Box_Item');
            $table->decimal('Tinggi_Kebutuhan_Karton_Box_Item');
            $table->decimal('Lebar_Kebutuhan_Karton_Box_Item');
            $table->decimal('Panjang_Kebutuhan_Karton_Box_Item');
            $table->decimal('Quantity_Kebutuhan_Karton_Box_Item');
            $table->decimal('Harga_Kebutuhan_Karton_Box_Item',20,2);
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
        Schema::dropIfExists('kebutuhan_karton_box_pos');
    }
};
