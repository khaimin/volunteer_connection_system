<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TV extends Model
{
    //
    protected $table = 't_vs';

	protected $filltable = ['IDTV','Ten','Email','Password', 'Longitude', 'Latitude', 'Avatar','Thongtin', 'DVHD', 'SĐT', 'Status', 'created_at'];
}
