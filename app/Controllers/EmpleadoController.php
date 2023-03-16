<?php

namespace  App\Controllers;

use App\Models\EmpleadoEntry;
use App\Response\CustomResponse;
use App\Validation\Validator;

use Respect\Validation\Exceptions\Exception;
use Respect\Validation\Validator as v;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class EmpleadoController
{
    protected $customResponse;
    protected $validator;
    protected $empleadoEntry;

    public function __construct(){
        $this->customResponse = new CustomResponse();
        $this->validator = new Validator();
        $this->empleadoEntry = new EmpleadoEntry();
    }
/* INICIO PROCESO TABLA EMPLEADO */
    public function viewEmpleadoGet(Response $response)
    {
        $arqueoGet = $this->empleadoEntry->get();
        return $this->customResponse->is200Response($response,$arqueoGet);
    }

      public function viewEmpleadoGetid(Response $response,$id)
    {
        $arqueoGet = $this->empleadoEntry->where(["ID_empleado"=>$id])->get();
        return $this->customResponse->is200Response($response,$arqueoGet);
    }

     public function viewEmpleadosucursalGet(Response $response,$id)
    {
        $arqueoGet = $this->empleadoEntry->where(["Id_sucursal"=>$id])->get();
        return $this->customResponse->is200Response($response,$arqueoGet);
    }

     public function deleteEmpleado(Response $response,$id)
    {
        $this->empleadoEntry->where(["ID_empleado"=>$id])->delete();
        $responseMessage = "el Cliente fue eliminado exitosamente";
        return $this->customResponse->is200Response($response,$responseMessage);
    }
    public function createEmpleado(Request $request,Response $response)
    {
        $data = json_decode($request->getBody(),true);

        $this->validator->validate($request,[
                "Id_sucursal"=>v::notEmpty(),
                "Id_ciudad"=>v::notEmpty(),
                "Documento"=>v::notEmpty(),
                "Nombres"=>v::notEmpty(),
                "Apellidos"=>v::notEmpty(),
                "Telefono"=>v::notEmpty(),
                "Email"=>v::notEmpty(),
                "Direccion"=>v::notEmpty()
        ]); 

       if($this->validator->failed())
       {
           $responseMessage = $this->validator->errors;
           return $this->customResponse->is400Response($response,$responseMessage);
       }

       try{

        $EmpleadoEntry = new EmpleadoEntry;
        $EmpleadoEntry->Id_sucursal         =   $data['Id_Registro'];
        $EmpleadoEntry->Id_ciudad           =   $data['Id_ciudad'];
        $EmpleadoEntry->documento           =   $data['Documento'];
        $EmpleadoEntry->cnombre             =   $data['Nombres'];
        $EmpleadoEntry->capellido           =   $data['Apellidos'];
        $EmpleadoEntry->tel_fijo_cel        =   $data['Telefono'];
        $EmpleadoEntry->email               =   $data['Email'];
        $EmpleadoEntry->direccion           =   $data['Direccion'];
        $EmpleadoEntry->save();

        $responseMessage = array('msg' 
        => "Cliente guardado correctamente",'id' 
        => $EmpleadoEntry->id);

        return $this->customResponse->is200Response($response,$responseMessage);

        }catch(Exception $err){

        $responseMessage = array("err" => $err->getMessage());
        return $this->customResponse->is400Response($response,$responseMessage);

       }
    }

       public function  editarEmpleado(Request $request,Response $response,$id)
    {
        $data = json_decode($request->getBody(),true);

        $this->validator->validate($request,[
                "Id_sucursal"=>v::notEmpty(),
                "Id_ciudad"=>v::notEmpty(),
                "Documento"=>v::notEmpty(),
                "Nombres"=>v::notEmpty(),
                "Apellidos"=>v::notEmpty(),
                "Telefono"=>v::notEmpty(),
                "Email"=>v::notEmpty(),
                "Direccion"=>v::notEmpty()
        ]); 

       if($this->validator->failed())
       {
           $responseMessage = $this->validator->errors;
           return $this->customResponse->is400Response($response,$responseMessage);
       }

       try{

        $EmpleadoEntry = EmpleadoEntry::find($id);
        $EmpleadoEntry->Id_sucursal         =   $data['Id_Registro'];
        $EmpleadoEntry->Id_ciudad           =   $data['Id_ciudad'];
        $EmpleadoEntry->documento           =   $data['Documento'];
        $EmpleadoEntry->cnombre             =   $data['Nombres'];
        $EmpleadoEntry->capellido           =   $data['Apellidos'];
        $EmpleadoEntry->tel_fijo_cel        =   $data['Telefono'];
        $EmpleadoEntry->email               =   $data['Email'];
        $EmpleadoEntry->direccion           =   $data['Direccion'];
        $EmpleadoEntry->save();

       $responseMessage = array('msg'
         => "Empleado editado correctamente",'id'
         => $id);

        return $this->customResponse->is200Response($response,$responseMessage);

        }catch(Exception $err){

        $responseMessage = array("err" => $err->getMessage());
        return $this->customResponse->is400Response($response,$responseMessage);

       }
    }
}
