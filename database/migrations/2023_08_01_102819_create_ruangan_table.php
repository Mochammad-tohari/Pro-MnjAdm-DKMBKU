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
        Schema::create('ruangan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Kode_Ruangan')->unique('Kode_Ruangan');
            $table->string('Gedung_Kode')->index('Gedung_id');
            $table->text('Nama_Ruangan');
            $table->text('Luas_Ruangan');
            $table->date('Tanggal_Operasional_Ruangan');
            $table->mediumText('Keterangan_Ruangan');
            $table->enum('Status_Ruangan', ['Aktif', 'Tidak_Aktif', 'Lainya']);
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
        Schema::dropIfExists('ruangan');
    }
};
