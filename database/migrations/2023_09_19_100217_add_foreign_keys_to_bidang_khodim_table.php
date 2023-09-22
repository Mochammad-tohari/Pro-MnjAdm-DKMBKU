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
        Schema::table('bidang_khodim', function (Blueprint $table) {
            $table->foreign(['updated_by'], 'bidang_khodim_ibfk_2')->references(['email'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['inserted_by'], 'bidang_khodim_ibfk_1')->references(['email'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bidang_khodim', function (Blueprint $table) {
            $table->dropForeign('bidang_khodim_ibfk_2');
            $table->dropForeign('bidang_khodim_ibfk_1');
        });
    }
};
