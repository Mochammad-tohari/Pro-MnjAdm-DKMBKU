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
        Schema::create('bidang_pengurus', function (Blueprint $table) {
            $table->char('id_bidang_pengurus', 36)->primary();
            $table->string('Kode_Bidang_Pengurus')->unique('Kode_Bidang_Pengurus');
            $table->text('Nama_Bidang_Pengurus');
            $table->mediumText('Keterangan_Bidang_Pengurus')->nullable();
            $table->enum('Status_Bidang_Pengurus', ['Aktif', 'Tidak_Aktif', 'Lainya']);
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
        Schema::dropIfExists('bidang_pengurus');
    }
};
