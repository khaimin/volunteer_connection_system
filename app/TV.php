<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TV extends Model
{
    //
    protected $table = 't_vs';

	protected $filltable = ['IDTV','Ten','Longitude', 'Latitude', 'Avatar','Thongtin', 'DVHD', 'SĐT', 'Status','idUser', 'created_at'];
}
