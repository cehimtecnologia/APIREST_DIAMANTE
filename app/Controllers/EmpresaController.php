<?php

namespace  App\Controllers;

use App\Models\EmpresaEntry;
use App\Response\CustomResponse;
use App\Validation\Validator;

use Respect\Validation\Exceptions\Exception;
use Respect\Validation\Validator as v;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class EmpresaController
{
    protected $customResponse;
    protected $validator;
    protected $empresaEntry;

   public function __construct(){
        $this->customResponse = new CustomResponse();
        $this->validator = new Validator();
        $this->empresaEntry = new EmpresaEntry();
    }

    /* INICIO PROCESO TABLA EMPRESA */
    public function viewEmpresaEntryGet(Response $response)
    {
        $arqueoGet = $this->empresaEntry->get();
        return $this->customResponse->is200Response($response,$arqueoGet);
    }

      public function viewEmpresaEntryGetid(Response $response,$id)
    {
        $arqueoGet = $this->empresaEntry->where(["ID_empresa"=>$id])->get();
        return $this->customResponse->is200Response($response,$arqueoGet);
    }

    public function createEmpresa(Request $request,Response $response)
    {
        $data = json_decode($request->getBody(),true);

        $this->validator->validate($request,[
                "Ip"=>v::notEmpty(),
                "Nit"=>v::notEmpty(),
                "Nom_empresa"=>v::notEmpty(),
                "Telefono"=>v::notEmpty(),
                "Direccion"=>v::notEmpty(),
                "Ciudad"=>v::notEmpty()
        ]); 

       if($this->validator->failed())
       {
           $responseMessage = $this->validator->errors;
           return $this->customResponse->is400Response($response,$responseMessage);
       }

       try{

        $EmpresaEntry = new EmpresaEntry;
        $EmpresaEntry->Ip           =   $data['Ip'];
        $EmpresaEntry->nit          =   $data['Nit'];
        $EmpresaEntry->nom_empresa  =   $data['Nom_empresa'];
        $EmpresaEntry->telefono     =   $data['Telefono'];
        $EmpresaEntry->direccion    =   $data['Direccion'];
        $EmpresaEntry->ciudad       =   $data['Ciudad'];
        $EmpresaEntry->save();

        $responseMessage = array('msg' 
        => "Empresa guardada correctamente",'id' 
        => $EmpresaEntry->id);

        return $this->customResponse->is200Response($response,$responseMessage);

        }catch(Exception $err){

        $responseMessage = array("err" => $err->getMessage());
        return $this->customResponse->is400Response($response,$responseMessage);

       }
    }

    public function editarEmpresa(Request $request,Response $response,$id)
    {
        $data = json_decode($request->getBody(),true);

        $this->validator->validate($request,[
                "Ip"=>v::notEmpty(),
                "Nit"=>v::notEmpty(),
                "Nom_empresa"=>v::notEmpty(),
                "Telefono"=>v::notEmpty(),
                "Direccion"=>v::notEmpty(),
                "Ciudad"=>v::notEmpty()
        ]); 

       if($this->validator->failed())
       {
           $responseMessage = $this->validator->errors;
           return $this->customResponse->is400Response($response,$responseMessage);
       }

       try{

        $EmpresaEntry = EmpresaEntry::find($id);
        $EmpresaEntry->Ip           =   $data['Ip'];
        $EmpresaEntry->nit          =   $data['Nit'];
        $EmpresaEntry->nom_empresa  =   $data['Nom_empresa'];
        $EmpresaEntry->telefono     =   $data['Telefono'];
        $EmpresaEntry->direccion    =   $data['Direccion'];
        $EmpresaEntry->ciudad       =   $data['Ciudad'];
        $EmpresaEntry->save();

        $responseMessage = array('msg' 
        => "Empresa guardada correctamente",'id' 
        => $EmpresaEntry->id);

        return $this->customResponse->is200Response($response,$responseMessage);

        }catch(Exception $err){

        $responseMessage = array("err" => $err->getMessage());
        return $this->customResponse->is400Response($response,$responseMessage);

       }
    }
}
