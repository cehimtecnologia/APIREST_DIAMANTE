<?php

namespace  App\Controllers;

use App\Models\SucursalEntry;
use App\Response\CustomResponse;
use App\Validation\Validator;

use Respect\Validation\Exceptions\Exception;
use Respect\Validation\Validator as v;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class SucursalController
{
    protected $customResponse;
    protected $validator;
    protected $sucursalEntry;

    public function __construct(){
        $this->customResponse = new CustomResponse();
        $this->validator = new Validator();
        $this->sucursalEntry = new SucursalEntry();
    }

    public function viewSucursalGet(Response $response)
    {
        $sucursalGet = $this->sucursalEntry->get();
        return $this->customResponse->is200Response($response,$sucursalGet);
    }

      public function viewSucursalGetid(Response $response,$id)
    {
        $arqueoGet = $this->sucursalEntry->where(["ID_sucursal"=>$id])->get();
        return $this->customResponse->is200Response($response,$arqueoGet);
    }

     public function viewCiudadsucursalGet(Response $response,$id)
    {
        $arqueoGet = $this->sucursalEntry->where(["Id_ciudad"=>$id])->get();
        return $this->customResponse->is200Response($response,$arqueoGet);
    }

     public function deleteSucursal(Response $response,$id)
    {
        $this->sucursalEntry->where(["ID_sucursal"=>$id])->delete();
        $responseMessage = "La sucursal fue eliminada exitosamente";
        return $this->customResponse->is200Response($response,$responseMessage);
    }

    public function createSucursal(Request $request,Response $response)
    {
        $data = json_decode($request->getBody(),true);

        $this->validator->validate($request,[
                "Id_ciudad"=>v::notEmpty(),
                "nombre"=>v::notEmpty(),
                "Telefono"=>v::notEmpty(),
                "Direccion"=>v::notEmpty(),
                "Check"=>v::notEmpty()
        ]); 

       if($this->validator->failed())
       {
           $responseMessage = $this->validator->errors;
           return $this->customResponse->is400Response($response,$responseMessage);
       }

       try{

        $SucursalEntry = new SucursalEntry;
        $SucursalEntry->Id_ciudad = $data['Id_ciudad'];
        $SucursalEntry->nombre    = $data['Nombre'];
        $SucursalEntry->telefono  = $data['Telefono'];
        $SucursalEntry->direccion = $data['Direccion'];
        $SucursalEntry->chkpv     = $data['Check'];
        $SucursalEntry->save();

        $responseMessage = array('msg' 
        => "Sucursal guardada correctamente",'id' 
        => $SucursalEntry->id);

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
                 "Id_ciudad"=>v::notEmpty(),
                "nombre"=>v::notEmpty(),
                "Telefono"=>v::notEmpty(),
                "Direccion"=>v::notEmpty(),
                "Check"=>v::notEmpty()
        ]); 

       if($this->validator->failed())
       {
           $responseMessage = $this->validator->errors;
           return $this->customResponse->is400Response($response,$responseMessage);
       }

       try{

        $SucursalEntry = SucursalEntry::find($id);
        $SucursalEntry->Id_ciudad = $data['Id_ciudad'];
        $SucursalEntry->nombre    = $data['Nombre'];
        $SucursalEntry->telefono  = $data['Telefono'];
        $SucursalEntry->direccion = $data['Direccion'];
        $SucursalEntry->chkpv     = $data['Check'];
        $SucursalEntry->save();

       $responseMessage = array('msg'
         => "Sucursal editada correctamente",'id'
         => $id);

        return $this->customResponse->is200Response($response,$responseMessage);

        }catch(Exception $err){

        $responseMessage = array("err" => $err->getMessage());
        return $this->customResponse->is400Response($response,$responseMessage);

       }
    }
}
