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
        Schema::create('murid_madrasah', function (Blueprint $table) {
            $table->char('id_murid', 36)->primary();
            $table->string('Kode_Murid')->unique('Kode_Murid');
            $table->text('Nama_Murid');
            $table->text('Tempat_Lahir_Murid');
            $table->date('Tanggal_Lahir_Murid');
            $table->text('Asal_Sekolah_Murid');
            $table->text('Nama_Ayah_Murid')->nullable();
            $table->text('Nama_Ibu_Murid')->nullable();
            $table->text('Nama_Wali_Murid')->nullable();
            $table->mediumText('Alamat_Murid');
            $table->binary('Foto_Murid')->nullable();
            $table->binary('Foto_Akta_Kelahiran_Murid')->nullable();
            $table->binary('Foto_KK_Murid')->nullable();
            $table->text('Tingkat_Murid');
            $table->mediumText('Keterangan_Murid')->nullable();
            $table->enum('Status_Murid', ['Aktif', 'Tidak_Aktif', 'Pindah', 'Lainya']);
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
        Schema::dropIfExists('murid_madrasah');
    }
};
