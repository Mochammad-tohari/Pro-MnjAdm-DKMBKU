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
        Schema::table('uji_user', function (Blueprint $table) {
            $table->foreign(['inserted_by'], 'uji_user_ibfk_1')->references(['email'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['Jabatan_Uji_User'], 'uji_user_ibfk_3')->references(['Kode_Bidang'])->on('uji_bidang')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['updated_by'], 'uji_user_ibfk_2')->references(['email'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('uji_user', function (Blueprint $table) {
            $table->dropForeign('uji_user_ibfk_1');
            $table->dropForeign('uji_user_ibfk_3');
            $table->dropForeign('uji_user_ibfk_2');
        });
    }
};
