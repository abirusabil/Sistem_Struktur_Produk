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
        Schema::create('master_accessories_hardware', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('Nama_Accessories_Hardware');
            $table->string('Ukuran_Accessories_Hardware');
            $table->string('Satuan_Accessories_Hardware');
            $table->decimal('Harga_Accessories_Hardware',12,2);
            $table->foreignId('Suplier_Id');
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
        Schema::dropIfExists('master_accessories_hardware');
    }
};
