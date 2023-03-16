<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;

class ComprasEntry extends Model
{
    public $timestamps = false;
    protected $table = "tbl_compras";
}

class ComprasProductoEntry extends Model
{
    public $timestamps = false;
    protected $table = "tbl_compras_producto";
}

class TrasladosEntry extends Model
{
    public $timestamps = false;
    protected $table = "tbl_traslados";
}