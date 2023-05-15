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
        Schema::create('master_komponen_finishings', function (Blueprint $table) {
            // $table->id();
            $table->string('id')->primary();
            $table->string('Nama_Komponen_Finishing');
            $table->decimal('Quantity_Komponen_Finishing');
            $table->string('Satuan_Komponen_Finishing');
            $table->decimal('Harga_Komponen_Finishing',12,2);
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
        Schema::dropIfExists('master_komponen_finishings');
    }
};
