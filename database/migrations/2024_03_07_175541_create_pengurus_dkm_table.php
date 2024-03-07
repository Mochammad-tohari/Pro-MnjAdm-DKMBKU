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
        Schema::create('pengurus_dkm', function (Blueprint $table) {
            $table->char('id_pengurus_dkm', 36)->primary();
            $table->string('Kode_Pengurus_DKM')->unique('Kode_Pengurus_DKM');
            $table->string('NIP_Pengurus_DKM')->nullable()->index('NIP_Pengurus_DKM');
            $table->string('Jabatan_Pengurus_DKM')->nullable()->index('Jabatan_Pengurus_DKM');
            $table->text('Nama_Pengurus_DKM');
            $table->text('Kontak_Pengurus_DKM');
            $table->mediumText('Alamat_Pengurus_DKM');
            $table->binary('Foto_Pengurus_DKM')->nullable();
            $table->binary('Identitas_Pengurus_DKM')->nullable();
            $table->mediumText('Keterangan_Pengurus_DKM')->nullable();
            $table->enum('Status_Pengurus_DKM', ['Aktif', 'Tidak_Aktif', 'Lainya']);
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
        Schema::dropIfExists('pengurus_dkm');
    }
};
