<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSKsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_ks', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('IDSK')->unique();
            $table->string('TenSK');
            $table->string('IDDV')->references('IDDV')->on('d_v_t_ns')->onDelete('cascade');
            $table->string('ThongtinSK');
            $table->text('KHCT');
            $table->date('TGSK');
            $table->string('DDSK');
            $table->string('SLDK');
            $table->string('kehoach');
            $table->double('Longitude',10,7);
            $table->double('Latitude',10,7);
            $table->integer('StatusSK');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('s_ks');
    }
}
