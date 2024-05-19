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
        Schema::table('pengajar_madrasah', function (Blueprint $table) {
            $table->foreign(['updated_by'], 'pengajar_madrasah_ibfk_2')->references(['email'])->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign(['inserted_by'], 'pengajar_madrasah_ibfk_1')->references(['email'])->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengajar_madrasah', function (Blueprint $table) {
            $table->dropForeign('pengajar_madrasah_ibfk_2');
            $table->dropForeign('pengajar_madrasah_ibfk_1');
        });
    }
};
