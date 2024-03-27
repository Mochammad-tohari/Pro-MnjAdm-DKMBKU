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
        Schema::table('inventaris', function (Blueprint $table) {
            $table->foreign(['inserted_by'], 'inventaris_ibfk_1')->references(['email'])->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign(['updated_by'], 'inventaris_ibfk_2')->references(['email'])->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventaris', function (Blueprint $table) {
            $table->dropForeign('inventaris_ibfk_1');
            $table->dropForeign('inventaris_ibfk_2');
        });
    }
};
