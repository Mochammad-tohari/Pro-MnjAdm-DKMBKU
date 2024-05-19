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
        Schema::create('pengajar_madrasah', function (Blueprint $table) {
            $table->char('id_pengajar', 36)->primary();
            $table->string('Kode_Pengajar')->unique('Kode_Pengajar');
            $table->text('Nama_Pengajar');
            $table->text('Kontak_Pengajar');
            $table->text('Alamat_Pengajar');
            $table->binary('Foto_Pengajar')->nullable();
            $table->binary('Identitas_Pengajar')->nullable();
            $table->mediumText('Keterangan_Pengajar')->nullable();
            $table->enum('Status_Pengajar', ['Aktif', 'Tidak_Aktif', 'Lainya']);
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
        Schema::dropIfExists('pengajar_madrasah');
    }
};
