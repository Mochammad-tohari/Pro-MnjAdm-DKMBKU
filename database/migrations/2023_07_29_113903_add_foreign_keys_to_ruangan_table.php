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
        Schema::table('ruangan', function (Blueprint $table) {
            $table->foreign(['Kode_Gedung'], 'ruangan_ibfk_1')->references(['Kode_Gedung'])->on('gedung')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ruangan', function (Blueprint $table) {
            $table->dropForeign('ruangan_ibfk_1');
        });
    }
};
