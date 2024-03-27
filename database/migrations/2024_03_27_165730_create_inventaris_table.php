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
        Schema::create('inventaris', function (Blueprint $table) {
            $table->char('id_inventaris', 36)->primary();
            $table->string('Kode_Inventaris')->unique('Kode_Inventaris');
            $table->text('Nama_Inventaris');
            $table->text('Merk_Inventaris')->nullable();
            $table->text('Jenis_Inventaris')->nullable();
            $table->binary('Foto_Inventaris')->nullable();
            $table->binary('Faktur_Inventaris')->nullable();
            $table->date('Tanggal_Operasional_Inventaris')->nullable();
            $table->mediumText('Keterangan_Inventaris')->nullable();
            $table->enum('Status_Inventaris', ['Aktif', 'Tidak_Aktif', 'Lainya']);
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
        Schema::dropIfExists('inventaris');
    }
};
