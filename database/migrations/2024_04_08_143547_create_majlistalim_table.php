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
        Schema::create('majlistalim', function (Blueprint $table) {
            $table->char('id_majlistalim', 36)->primary();
            $table->string('Kode_Majlistalim')->unique('Kode_Majlistalim');
            $table->text('Nama_Majlistalim');
            $table->text('Penanggung_Jawab_Majlistalim')->nullable();
            $table->text('Kontak_Majlistalim');
            $table->binary('Logo_Majlistalim')->nullable();
            $table->mediumText('Keterangan_Majlistalim')->nullable();
            $table->enum('Status_Majlistalim', ['Aktif', 'Tidak_Aktif', 'Lainya']);
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
        Schema::dropIfExists('majlistalim');
    }
};
