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
            $table->string('EmailDV');
            $table->string('PasswordDV');
            $table->string('AvatarDV');
            $table->string('LongitudeDV');
            $table->string('LatitudeDV');
            $table->text('ThongtinDV');
            $table->string('DVHDDV');
            $table->bigInteger('SDTDV');
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
