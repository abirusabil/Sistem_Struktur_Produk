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
        Schema::create('kebutuhan_plywood_mdf_pos', function (Blueprint $table) {
            $table->id();
            $table->string('Job_Order')->foreign()->references('id')->on('purchase_orders');
            $table->string('Nama_Item');
            $table->decimal('Quantity_Purchase_Order');
            $table->string('No_Cutting')->foreign()->references('id')->on('kebutuhan_plywood_mdf_items');
            $table->string('Plywood_MDF_Id')->foreign()->references('id')->on('master_plywood_mdfs');
            $table->string('Nama_Plywood_MDF');
            $table->string('KP_Kebutuhan_Plywood_MDF_Item');
            $table->string('Keterangan_Kebutuhan_Plywood_MDF_Item');
            $table->string('Grade_Kebutuhan_Plywood_MDF_Item');
            $table->decimal('Tebal_Plywood_MDF');
            $table->decimal('Lebar_Kebutuhan_Plywood_MDF_Item');
            $table->decimal('Panjang_Kebutuhan_Plywood_MDF_Item');
            $table->decimal('Quantity_Kebutuhan_Plywood_MDF_Item');
            $table->decimal('Luas_Plywood_MDF');
            $table->decimal('Harga_Plywood_MDF',20,2);
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
        Schema::dropIfExists('kebutuhan_plywood_mdf_pos');
    }
};
