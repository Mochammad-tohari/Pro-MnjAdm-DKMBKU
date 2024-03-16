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
        Schema::table('bidang_nawa', function (Blueprint $table) {
            $table->foreign(['inserted_by'], 'bidang_nawa_ibfk_1')->references(['email'])->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign(['updated_by'], 'bidang_nawa_ibfk_2')->references(['email'])->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bidang_nawa', function (Blueprint $table) {
            $table->dropForeign('bidang_nawa_ibfk_1');
            $table->dropForeign('bidang_nawa_ibfk_2');
        });
    }
};
