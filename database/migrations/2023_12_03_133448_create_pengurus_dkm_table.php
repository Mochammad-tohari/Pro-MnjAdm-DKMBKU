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
            $table->char('id_pengurus', 36)->primary();
            $table->string('Kode_Pengurus')->unique('Kode_Pengurus');
            $table->string('NIP_Pengurus')->nullable()->unique('NIP_Pengurus');
            $table->string('Jabatan_Pengurus')->index('Jabatan_Pengurus');
            $table->text('Nama_Pengurus');
            $table->text('Kontak_Pengurus');
            $table->mediumText('Alamat_Pengurus');
            $table->binary('Foto_Pengurus')->nullable();
            $table->binary('Identitas_Pengurus')->nullable();
            $table->mediumText('Keterangan_Pengurus')->nullable();
            $table->enum('Status_Pengurus', ['Aktif', 'Tidak_Aktif', 'Lainya']);
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
        Schema::dropIfExists('pengurus_dkm');
    }
};
