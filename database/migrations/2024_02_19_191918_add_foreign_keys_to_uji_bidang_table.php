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
        Schema::table('uji_bidang', function (Blueprint $table) {
            $table->foreign(['inserted_by'], 'uji_bidang_ibfk_1')->references(['email'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['updated_by'], 'uji_bidang_ibfk_2')->references(['email'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('uji_bidang', function (Blueprint $table) {
            $table->dropForeign('uji_bidang_ibfk_1');
            $table->dropForeign('uji_bidang_ibfk_2');
        });
    }
};
