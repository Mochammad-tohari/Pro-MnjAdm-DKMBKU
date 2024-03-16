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
        Schema::table('pengurus_nawa', function (Blueprint $table) {
            $table->foreign(['Jabatan_Pengurus_Nawa'], 'pengurus_nawa_ibfk_1')->references(['Kode_Bidang_Nawa'])->on('bidang_nawa')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign(['updated_by'], 'pengurus_nawa_ibfk_3')->references(['email'])->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign(['inserted_by'], 'pengurus_nawa_ibfk_2')->references(['email'])->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengurus_nawa', function (Blueprint $table) {
            $table->dropForeign('pengurus_nawa_ibfk_1');
            $table->dropForeign('pengurus_nawa_ibfk_3');
            $table->dropForeign('pengurus_nawa_ibfk_2');
        });
    }
};
