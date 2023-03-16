<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;

class CiudadEntry extends Model
{
    public $timestamps = false;
    protected $table = "tbl_ciudad";
}

class RegionEntry extends Model
{
    public $timestamps = false;
    protected $table = "tbl_region";
}
