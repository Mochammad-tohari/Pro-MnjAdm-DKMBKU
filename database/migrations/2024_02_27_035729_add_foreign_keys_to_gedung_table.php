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
        Schema::table('gedung', function (Blueprint $table) {
            $table->foreign(['updated_by'], 'gedung_ibfk_2')->references(['email'])->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign(['inserted_by'], 'gedung_ibfk_1')->references(['email'])->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gedung', function (Blueprint $table) {
            $table->dropForeign('gedung_ibfk_2');
            $table->dropForeign('gedung_ibfk_1');
        });
    }
};
