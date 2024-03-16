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
        Schema::create('bidang_nawa', function (Blueprint $table) {
            $table->char('id_bidang_nawa', 36)->primary();
            $table->string('Kode_Bidang_Nawa')->unique('Kode_Bidang_Nawa');
            $table->text('Nama_Bidang_Nawa');
            $table->mediumText('Keterangan_Bidang_Nawa')->nullable();
            $table->enum('Status_Bidang_Nawa', ['Aktif', 'Tidak_Aktif', 'Lainya']);
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
        Schema::dropIfExists('bidang_nawa');
    }
};
