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
        Schema::create('pengurus_nawa', function (Blueprint $table) {
            $table->char('id_pengurus_nawa', 36)->primary();
            $table->string('Kode_Pengurus_Nawa')->unique('Kode_Pengurus_Nawa');
            $table->string('NIP_Pengurus_Nawa')->nullable()->index('NIP_Pengurus_Nawa');
            $table->string('Jabatan_Pengurus_Nawa')->nullable()->index('Jabatan_Pengurus_Nawa');
            $table->text('Nama_Pengurus_Nawa');
            $table->text('Kontak_Pengurus_Nawa');
            $table->mediumText('Alamat_Pengurus_Nawa');
            $table->binary('Foto_Pengurus_Nawa')->nullable();
            $table->binary('Identitas_Pengurus_Nawa')->nullable();
            $table->mediumText('Keterangan_Pengurus_Nawa')->nullable();
            $table->enum('Status_Pengurus_Nawa', ['Aktif', 'Tidak_Aktif', 'Lainya']);
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
        Schema::dropIfExists('pengurus_nawa');
    }
};
