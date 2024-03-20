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
            $table->text('Kontak_Murid');
            $table->mediumText('Alamat_Murid');
            $table->binary('Foto_Murid')->nullable();
            $table->binary('Foto_Akta_Kelahiran_Murid')->nullable();
            $table->binary('Foto_KK_Murid')->nullable();
            $table->text('Tingkat_Murid');
            $table->mediumText('Keterangan_Murid')->nullable();
            $table->enum('Status_Murid', ['Aktif', 'Tidak_Aktif', 'Lainya']);
            $table->string('inserted_by')->nullable();
            $table->string('updated_by')->nullable()->index('updated_by');
            $table->timestamps();

            $table->index(['inserted_by', 'updated_by'], 'inserted_by');
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
