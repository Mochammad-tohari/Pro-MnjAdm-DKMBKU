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
        Schema::create('uji', function (Blueprint $table) {
            $table->uuid('id')->primary();
            //$table->bigIncrements('id');
            $table->string('Kode', 25)->unique('Kode');
            $table->text('Nama');
            $table->text('Password');
            $table->date('Tanggal_masuk');
            $table->enum('Status', ['Aktif', 'Tidak_Aktif']);
            $table->binary('Foto1')->nullable();
            $table->binary('Foto2')->nullable();
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
        Schema::dropIfExists('uji');
    }
};
