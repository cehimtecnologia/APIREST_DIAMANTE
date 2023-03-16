<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;

class BodegaEntry extends Model
{
    public $timestamps = false;
    protected $table = "tbl_bodega_principal";
}

class BodegaSucursalEntry extends Model
{
    public $timestamps = false;
    protected $table = "tbl_bodega_sucursal";
}

class MarcaEntry extends Model
{
    public $timestamps = false;
    protected $table = "tbl_marca";
}

class PresentacionEntry extends Model
{
    public $timestamps = false;
    protected $table = "tbl_presentacion";
}

class CategoriaEntry extends Model
{
    public $timestamps = false;
    protected $table = "tbl_categoria";
}
