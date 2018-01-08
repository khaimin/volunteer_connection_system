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
            $table->increments('id');
            $table->timestamps();
            $table->string('IDTV')->unique();
            $table->string('Ten');
            $table->double('Longitude',10,7);
            $table->double('Latitude',10,7);
            $table->string('Avatar');
            $table->text('Thongtin');
            $table->string('DVHD');
            $table->bigInteger('SĐT');
            $table->integer('idUser')->unsigned();
            $table->foreign('idUser')->references('id')->on('users')->onDelete('cascade');
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
