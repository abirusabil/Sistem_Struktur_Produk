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
        Schema::create('kebutuhan_accessories_hardware_items', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('Item_Id')->foreign()->references('id')->on('items');
            $table->string('Accessories_Hardware_Id')->foreign()->references('id')->on('master_accessories_hardware');
            $table->string('Keterangan_Kebutuhan_Accessories_Hardware_Item');
            $table->decimal('Quantity_Kebutuhan_Accessories_Hardware_Item');
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
        Schema::dropIfExists('kebutuhan_accessories_hardware_items');
    }
};
