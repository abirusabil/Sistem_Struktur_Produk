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
        Schema::create('master_karton_boxes', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('Jenis_Karton_Box');
            $table->string('Satuan_Karton_Box');
            $table->string('Harga_Karton_Box');
            $table->string('Suplier_Id');
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
        Schema::dropIfExists('master_karton_boxes');
    }
};
