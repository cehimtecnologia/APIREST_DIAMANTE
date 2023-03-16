<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;

class ArqueoEntry extends Model
{
    public $timestamps = false;
    protected $table = "tbl_arqueo";
}

class DivisasEntry extends Model
{
    public $timestamps = false;
    protected $table = "tbl_divisas";
}

class DivisasArqueoEntry extends Model
{
    public $timestamps = false;
    protected $table = "tbl_divisas_arq";
}
