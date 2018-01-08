<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DVTN extends Model
{
    //
    protected $table = 'd_v_t_ns';

	protected $filltable = ['IDDV','TenDV','AvatarDV','LongitudeDV', 'LatitudeDV', 'DVHDDV', 'SDTDV', 'StatusDV', 'ThongtinDV','idDVTN', 'created_at'];
}
