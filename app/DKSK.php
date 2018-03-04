<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DKSK extends Model
{
        //
    protected $table = 'd_k_s_ks';

	protected $filltable = ['id', 'IDTV', 'IDSK', 'created_at'];
}
