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
        Schema::table('murid_madrasah', function (Blueprint $table) {
            $table->foreign(['inserted_by'], 'murid_madrasah_ibfk_1')->references(['email'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['updated_by'], 'murid_madrasah_ibfk_2')->references(['email'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('murid_madrasah', function (Blueprint $table) {
            $table->dropForeign('murid_madrasah_ibfk_1');
            $table->dropForeign('murid_madrasah_ibfk_2');
        });
    }
};
