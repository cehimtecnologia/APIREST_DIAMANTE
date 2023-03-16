<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientesEntry extends Model
{
    public $timestamps = false;
    protected $table = "tbl_clientes";
}

class ReferidosEntry extends Model
{
    public $timestamps = false;
    protected $table = "tbl_referidos";
}

class PuntosEntry extends Model
{
    public $timestamps = false;
    protected $table = "tbl_puntos";
}

class AvatarclienteEntry extends Model
{
    public $timestamps = false;
    protected $table = "tbl_avatar_cliente";
}