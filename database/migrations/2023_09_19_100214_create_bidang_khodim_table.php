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
        Schema::create('bidang_khodim', function (Blueprint $table) {
            $table->char('id_bidang_khodim', 36)->primary();
            $table->string('Kode_Bidang_Khodim')->unique('Kode_Bidang_Khodim');
            $table->text('Nama_Bidang_Khodim');
            $table->mediumText('Keterangan_Bidang_Khodim')->nullable();
            $table->enum('Status_Bidang_Khodim', ['Aktif', 'Tidak_Aktif', 'Lainya']);
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
        Schema::dropIfExists('bidang_khodim');
    }
};
