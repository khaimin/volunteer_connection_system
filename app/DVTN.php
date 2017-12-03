<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DVTN extends Model
{
    //
    protected $table = 'd_v_t_ns';

	protected $filltable = ['IDDV','TenDV','EmailDV','PasswordDV','AvatarDV','LongitudeDV', 'LatitudeDV', 'DVHDDV', 'SDTDV', 'StatusDV', 'ThongtinDV', 'created_at'];
}
