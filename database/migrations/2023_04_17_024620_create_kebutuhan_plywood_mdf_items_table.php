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
        Schema::create('kebutuhan_plywood_mdf_items', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('Item_Id')->foreign()->references('id')->on('items');
            $table->string('Plywood_MDF_Id')->foreign()->references('id')->on('master_plywood_mdfs');
            $table->string('KP_Kebutuhan_Plywood_MDF_Item');
            $table->string('Keterangan_Kebutuhan_Plywood_MDF_Item');
            $table->string('Grade_Kebutuhan_Plywood_MDF_Item');
            $table->decimal('Lebar_Kebutuhan_Plywood_MDF_Item');
            $table->decimal('Panjang_Kebutuhan_Plywood_MDF_Item');
            $table->decimal('Quantity_Kebutuhan_Plywood_MDF_Item');
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
        Schema::dropIfExists('kebutuhan_plywood_mdf_items');
    }
};
