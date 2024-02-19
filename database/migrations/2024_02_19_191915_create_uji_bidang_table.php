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
        Schema::create('uji_bidang', function (Blueprint $table) {
            $table->char('id_uji_bidang', 36)->primary();
            $table->string('Kode_Bidang')->unique('Kode_Bidang');
            $table->text('Nama_Bidang');
            $table->mediumText('Keterangan_Bidang')->nullable();
            $table->enum('Status_Bidang', ['Aktif', 'Tidak_Aktif', 'Lainya']);
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
        Schema::dropIfExists('uji_bidang');
    }
};
