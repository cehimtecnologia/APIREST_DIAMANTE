<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;

class SucursalEntry extends Model
{
    public $timestamps = false;
    protected $table = "tbl_sucursal";
}

class EmpleadoEntry extends Model
{
    public $timestamps = false;
    protected $table = "tbl_empleado";
}

class AvatarempleadoEntry extends Model
{
    public $timestamps = false;
    protected $table = "tbl_avatar_empleado";
}

class EmpresaEntry extends Model
{
    public $timestamps = false;
    protected $table = "tbl_empresa";
}