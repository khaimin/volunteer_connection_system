<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SK extends Model
{
    //
    protected $table = 's_ks';

	protected $filltable = ['IDSK','TenSK','IDDV','ThongtinSK', 'KHCT', 'TGSK','Longitude', 'Latitude', 'DDSK','StatusSK','kehoach', 'created_at'];
}
