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
        Schema::create('gedung', function (Blueprint $table) {
            $table->char('id_gedung', 36)->primary();
            $table->string('Kode_Gedung')->unique('Kode_Gedung');
            $table->text('Nama_Gedung');
            $table->text('Dimensi_Gedung');
            $table->date('Tanggal_Operasional_Gedung');
            $table->mediumText('Keterangan_Gedung')->nullable();
            $table->enum('Status_Gedung', ['Aktif', 'Tidak_Aktif', 'Lainya']);
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
        Schema::dropIfExists('gedung');
    }
};
