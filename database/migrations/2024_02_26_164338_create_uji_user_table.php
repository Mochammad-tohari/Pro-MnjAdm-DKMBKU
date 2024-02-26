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
        Schema::create('uji_user', function (Blueprint $table) {
            $table->char('id_uji_user', 36)->primary();
            $table->string('Kode_Uji_User')->unique('Kode_Uji_User');
            $table->string('Jabatan_Uji_User')->nullable()->index('Jabatan_Uji_User');
            $table->text('Nama_Uji_User');
            $table->string('Password_Uji_User');
            $table->date('Tanggal_Uji_User');
            $table->mediumText('Keterangan_Uji_User')->nullable();
            $table->binary('Foto_Profil')->nullable();
            $table->binary('Foto_Identitas')->nullable();
            $table->enum('Status_Uji_User', ['Aktif', 'Tidak_Aktif', 'Lainya']);
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
        Schema::dropIfExists('uji_user');
    }
};
