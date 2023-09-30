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
        Schema::create('khodim_dkm', function (Blueprint $table) {
            $table->char('id_khodim', 36)->primary();
            $table->string('Kode_Khodim')->unique('Kode_Khodim');
            $table->string('Jabatan_Khodim')->index('Jabatan_Khodim');
            $table->text('Nama_Khodim');
            $table->text('Kontak_Khodim');
            $table->mediumText('Alamat_Khodim');
            $table->binary('Foto_Khodim')->nullable();
            $table->binary('Identitas_Khodim')->nullable();
            $table->mediumText('Keterangan_Khodim')->nullable();
            $table->enum('Status_Khodim', ['Aktif', 'Tidak_Aktif', 'Lainya']);
            $table->string('inserted_by')->nullable()->index('inserted_by');
            $table->string('updated_by')->nullable()->index('updated_by');
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
        Schema::dropIfExists('khodim_dkm');
    }
};
