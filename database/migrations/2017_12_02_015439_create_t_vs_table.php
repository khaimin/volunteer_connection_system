<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTVsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_vs', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->timestamps();
            $table->string('IDTV');
            $table->string('Ten');
            $table->string('Email');
            $table->string('Password');
            $table->string('Longitude');
            $table->string('Latitude');
            $table->string('Avatar');
            $table->text('Thongtin');
            $table->string('DVHD');
            $table->bigInteger('SĐT');
            $table->integer('Status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('t_vs');
    }
}
