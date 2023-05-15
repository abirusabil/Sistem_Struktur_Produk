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
        Schema::create('items', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('Nama_Item');
            $table->decimal('Tinggi_Item');
            $table->decimal('Lebar_Item');
            $table->decimal('Panjang_Item');
            $table->decimal('Berat_Item');
            $table->string('Warna_Item');
            $table->string('Collection_Id')->foreign()->references('id')->on('collections');
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
        Schema::dropIfExists('items');
    }
};
