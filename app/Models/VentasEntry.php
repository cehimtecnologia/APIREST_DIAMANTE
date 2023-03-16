<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;

class VentasEntry extends Model
{
    public $timestamps = false;
    protected $table = "tbl_ventas";
}

class CreditosEntry extends Model
{
    public $timestamps = false;
    protected $table = "tbl_ventas_credito";
}

class VentasProductoEntry extends Model
{
    public $timestamps = false;
    protected $table = "tbl_ventas_producto";
}

class TipoventaEntry extends Model
{
    public $timestamps = false;
    protected $table = "tbl_tipo_venta";
}
