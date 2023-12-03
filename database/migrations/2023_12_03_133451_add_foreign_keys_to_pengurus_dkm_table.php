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
        Schema::table('pengurus_dkm', function (Blueprint $table) {
            $table->foreign(['Jabatan_Pengurus'], 'pengurus_dkm_ibfk_1')->references(['Kode_Bidang_Pengurus'])->on('bidang_pengurus')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['updated_by'], 'pengurus_dkm_ibfk_3')->references(['email'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['inserted_by'], 'pengurus_dkm_ibfk_2')->references(['email'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengurus_dkm', function (Blueprint $table) {
            $table->dropForeign('pengurus_dkm_ibfk_1');
            $table->dropForeign('pengurus_dkm_ibfk_3');
            $table->dropForeign('pengurus_dkm_ibfk_2');
        });
    }
};
