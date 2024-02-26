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
            $table->char('id_ruangan', 36)->primary();
            $table->string('Kode_Ruangan')->unique('Kode_Ruangan');
            $table->string('Gedung_Kode')->nullable()->index('Gedung_Kode');
            $table->text('Nama_Ruangan');
            $table->text('Luas_Ruangan');
            $table->date('Tanggal_Operasional_Ruangan')->nullable();
            $table->mediumText('Keterangan_Ruangan')->nullable();
            $table->binary('Foto_Ruangan')->nullable();
            $table->enum('Status_Ruangan', ['Aktif', 'Tidak_Aktif', 'Lainya']);
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
        Schema::dropIfExists('ruangan');
    }
};
