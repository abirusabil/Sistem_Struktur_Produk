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
        Schema::create('kebutuhan_karton_box_items', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('Item_Id')->foreign()->references('id')->on('items');
            $table->string('Jenis_Kebutuhan_Karton_Box');
            $table->string('Keterangan_Kebutuhan_Karton_Box_Item');
            $table->decimal('Tinggi_Kebutuhan_Karton_Box_Item');
            $table->decimal('Lebar_Kebutuhan_Karton_Box_Item');
            $table->decimal('Panjang_Kebutuhan_Karton_Box_Item');
            $table->decimal('Quantity_Kebutuhan_Karton_Box_Item');
            $table->decimal('Harga_Kebutuhan_Karton_Box_Item');
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
        Schema::dropIfExists('kebutuhan_karton_box_items');
    }
};
