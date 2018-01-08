<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateDVTNsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_v_t_ns', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('IDDV')->unique();
            $table->string('TenDV');
            $table->string('AvatarDV');
            $table->double('LongitudeDV',10,7);
            $table->double('LatitudeDV',10,7);
            $table->text('ThongtinDV');
            $table->string('DVHDDV');
            $table->bigInteger('SDTDV');
            $table->integer('idDVTN')->unsigned();
            $table->foreign('idDVTN')->references('id')->on('users')->onDelete('cascade');
            $table->integer('StatusDV')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('d_v_t_ns');
    }
}
