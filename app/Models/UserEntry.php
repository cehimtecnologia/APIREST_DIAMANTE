<?php
namespace  App\Models;
use Illuminate\Database\Eloquent\Model;

class UserEntry extends Model
{
  public $timestamps = false;
  protected $table = "tbl_user_login";
}

class UserEntryRoll extends Model
{
  public $timestamps = false;
  protected $table = "tbl_user_roll";
}
class UserEntryAudit extends Model
{
  public $timestamps = false;
  protected $table = "tbl_user_auditoria";
}

class UserEntryPermiso extends Model
{
  public $timestamps = false;
  protected $table = "tbl_user_permiso";
}
class UserEntryMenu extends Model
{
  public $timestamps = false;
  protected $table = "tbl_user_menu";
}

class UserEntryMenu_usuario extends Model
{
  public $timestamps = false;
  protected $table = "tbl_menu_usuario";
}

class UserEntryAcceso extends Model
{
  public $timestamps = false;
  protected $table = "tbl_user_acceso";
}

class UserGT extends Model
{
  public $timestamps = false;
  protected $table = "tbl_gt_user";
}

class UserEntrySalida extends Model
{
  public $timestamps = false;
  protected $table = "tbl_salida";
}

class UserEntryEntrada extends Model
{
  public $timestamps = false;
  protected $table = "tbl_entrada";
}
