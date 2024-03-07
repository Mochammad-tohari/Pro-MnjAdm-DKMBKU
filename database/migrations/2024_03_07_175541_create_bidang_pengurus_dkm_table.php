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
        Schema::create('bidang_pengurus_dkm', function (Blueprint $table) {
            $table->char('id_bidang_pengurus_dkm', 36)->primary();
            $table->string('Kode_Bidang_Pengurus_DKM')->unique('Kode_Bidang_Pengurus_DKM');
            $table->text('Nama_Bidang_Pengurus_DKM');
            $table->mediumText('Keterangan_Bidang_Pengurus_DKM')->nullable();
            $table->enum('Status_Bidang_Pengurus_DKM', ['Aktif', 'Tidak_Aktif', 'Lainya']);
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
        Schema::dropIfExists('bidang_pengurus_dkm');
    }
};
