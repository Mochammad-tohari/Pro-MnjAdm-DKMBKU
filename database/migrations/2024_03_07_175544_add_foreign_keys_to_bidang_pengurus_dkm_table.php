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
        Schema::table('bidang_pengurus_dkm', function (Blueprint $table) {
            $table->foreign(['updated_by'], 'bidang_pengurus_dkm_ibfk_2')->references(['email'])->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign(['inserted_by'], 'bidang_pengurus_dkm_ibfk_1')->references(['email'])->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bidang_pengurus_dkm', function (Blueprint $table) {
            $table->dropForeign('bidang_pengurus_dkm_ibfk_2');
            $table->dropForeign('bidang_pengurus_dkm_ibfk_1');
        });
    }
};
