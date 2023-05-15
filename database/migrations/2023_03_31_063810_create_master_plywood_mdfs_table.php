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
        Schema::create('master_plywood_mdfs', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('Nama_Plywood_MDF');
            $table->string('Satuan_Plywood_MDF');
            $table->decimal('Tebal_Plywood_MDF');
            $table->decimal('Panjang_Plywood_MDF');
            $table->decimal('Lebar_Plywood_MDF');
            $table->decimal('Harga_Plywood_MDF',12,2);
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
        Schema::dropIfExists('master_plywood_mdfs');
    }
};
