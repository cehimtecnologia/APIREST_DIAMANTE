<?php

namespace  App\Controllers;

use App\Models\DivisasEntry;
use App\Models\DivisasArqueoEntry;
use App\Models\ArqueoEntry;

use App\Response\CustomResponse;
use App\Validation\Validator;
use Respect\Validation\Exceptions\Exception;
use Respect\Validation\Validator as v;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ArqueoController
{
    protected $customResponse;
     protected $validator;
    protected $divisasEntry;
    protected $divisasArqueoEntry;
    protected $arqueoEntry;

    public function __construct()
    {
        $this->customResponse = new CustomResponse();
        $this->validator = new Validator();
        $this->divisasEntry = new DivisasEntry();
        $this->divisasArqueoEntry = new DivisasArqueoEntry();
        $this->arqueoEntry = new ArqueoEntry();
    }

/* INICIO PROCESO TABLA ARQUEO */
 public function viewArqueoGet(Response $response)
    {
        $arqueoGet = $this->arqueoEntry->get();
        return $this->customResponse->is200Response($response,$arqueoGet);
    }

      public function viewArqueoGetid(Response $response,$id)
    {
        $arqueoGet = $this->arqueoEntry->where(["ID_arqueo"=>$id])->get();
        return $this->customResponse->is200Response($response,$arqueoGet);
    }

     public function deleteArqueo(Response $response,$id)
    {
        $this->arqueoEntry->where(["ID_arqueo"=>$id])->delete();
        $responseMessage = "el Arqueo fue eliminado exitosamente";
        return $this->customResponse->is200Response($response,$responseMessage);
    }

    public function createArqueo(Request $request,Response $response)
    {
        $data = json_decode($request->getBody(),true);

        $this->validator->validate($request,[
                "Id_vendedor"=>v::notEmpty(),
                "Arqueo_recibido"=>v::notEmpty(),
                "Arqueo_credito"=>v::notEmpty(),
                "Arqueo_venta"=>v::notEmpty(),
                "Arqueo_cambio"=>v::notEmpty()
        ]); 

       if($this->validator->failed())
       {
           $responseMessage = $this->validator->errors;
           return $this->customResponse->is400Response($response,$responseMessage);
       }

       try{

        $ArqueoEntry = new ArqueoEntry;
        $ArqueoEntry->Id_vendedor  =   $data['Id_vendedor'];
        $ArqueoEntry->arq_recibido =   $data['Arqueo_recibido'];
        $ArqueoEntry->arq_credito  =   $data['Arqueo_credito'];
        $ArqueoEntry->arq_venta    =   $data['Arqueo_venta'];
        $ArqueoEntry->arq_cambio   =   $data['Arqueo_cambio'];
        $ArqueoEntry->save();

        $responseMessage = array('msg' 
        => "Divisa guardada correctamente",'id' 
        => $ArqueoEntry->id);

        return $this->customResponse->is200Response($response,$responseMessage);

        }catch(Exception $err){

        $responseMessage = array("err" => $err->getMessage());
        return $this->customResponse->is400Response($response,$responseMessage);

       }
    }
    public function editarArqueo(Request $request,Response $response,$id)
    {
         $data = json_decode($request->getBody(),true);

        $this->validator->validate($request,[
                "Id_vendedor"=>v::notEmpty(),
                "Arqueo_recibido"=>v::notEmpty(),
                "Arqueo_credito"=>v::notEmpty(),
                "Arqueo_venta"=>v::notEmpty(),
                "Arqueo_cambio"=>v::notEmpty()
        ]);

        if($this->validator->failed())
        {
            $responseMessage = $this->validator->errors;
            return $this->customResponse->is400Response($response,$responseMessage);
        }

        try{
        $ArqueoEntry = DivisasEntry::find($id);
        $ArqueoEntry->Id_vendedor  =   $data['Id_vendedor'];
        $ArqueoEntry->arq_recibido =   $data['Arqueo_recibido'];
        $ArqueoEntry->arq_credito  =   $data['Arqueo_credito'];
        $ArqueoEntry->arq_venta    =   $data['Arqueo_venta'];
        $ArqueoEntry->arq_cambio   =   $data['Arqueo_cambio'];
        $ArqueoEntry->save();

        $responseMessage = array('msg'
         => "Divisa editada correctamente",'id'
         => $id);

        return $this->customResponse->is200Response($response,$responseMessage);

        }catch(Exception $err){
        $responseMessage = array("err" => $err->getMessage());
        return $this->customResponse->is400Response($response,$responseMessage);
       }
    }
/* FIN PROCESO TABLA ARQUEO */
/* INICIO PROCESO TABLA DIVISAS */
  public function viewDivisasGet(Response $response)
    {
        $divisasGet = $this->divisasEntry->get();
        return $this->customResponse->is200Response($response,$divisasGet);
    }

      public function viewDivisasGetid(Response $response,$id)
    {
        $divisasGet = $this->divisasEntry->where(["ID_divisa"=>$id])->get();
        return $this->customResponse->is200Response($response,$divisasGet);
    }

     public function deleteDivisas(Response $response,$id)
    {
        $this->divisasEntry->where(["ID_divisa"=>$id])->delete();
        $responseMessage = "La divisa fue eliminada exitosamente";
        return $this->customResponse->is200Response($response,$responseMessage);
    }

     public function createDivisas(Request $request,Response $response)
    {

    $data = json_decode($request->getBody(),true);

        $this->validator->validate($request,[
                "Valor"=>v::notEmpty(),
                "Tipo_divisa"=>v::notEmpty(),
                "Nombre_divisa"=>v::notEmpty()
        ]); 

       if($this->validator->failed())
       {
           $responseMessage = $this->validator->errors;
           return $this->customResponse->is400Response($response,$responseMessage);
       }
 try{
       
        $divisasEntry = new DivisasEntry;
        $divisasEntry->valor         =   $data['Valor'];
        $divisasEntry->tipo_divisa   =   $data['Tipo_divisa'];
        $divisasEntry->nom_divisa    =   $data['Nombre_divisa'];
        $divisasEntry->save();

        $responseMessage = array('msg'
         => "Divisa guardada correctamente",'id' 
         => $divisasEntry->id);
        return $this->customResponse->is200Response($response,$responseMessage);

        }catch(Exception $err){

        $responseMessage = array("err" => $err->getMessage());
        return $this->customResponse->is400Response($response,$responseMessage);

       }
    }

   public function editarDivisas(Request $request,Response $response,$id)
    {
         $data = json_decode($request->getBody(),true);

        $this->validator->validate($request,[
                "Valor"=>v::notEmpty(),
                "Tipo_divisa"=>v::notEmpty(),
                "Nombre_divisa"=>v::notEmpty()
        ]);

        if($this->validator->failed())
        {
            $responseMessage = $this->validator->errors;
            return $this->customResponse->is400Response($response,$responseMessage);
        }

        try{
        $divisasEntry = DivisasEntry::find($id);
        $divisasEntry->valor         =   $data['Valor'];
        $divisasEntry->tipo_divisa   =   $data['Tipo_divisa'];
        $divisasEntry->nom_divisa    =   $data['Nombre_divisa'];
        $divisasEntry->save();

        $responseMessage = array('msg' 
        => "Divisa editada correctamente",'id' 
        => $id);

        return $this->customResponse->is200Response($response,$responseMessage);

        }catch(Exception $err){
        $responseMessage = array("err" => $err->getMessage());
        return $this->customResponse->is400Response($response,$responseMessage);
       }
    }

   /* FIN TABLA DIVISAS */
   /* INICIO PROCESO TABLA DIVISASARQUEO */
 public function viewDivisasArqueoGet(Response $response)
    {
        $divisasArqueoGet = $this->divisasArqueoEntry->get();
        return $this->customResponse->is200Response($response,$divisasArqueoGet);
    }
         public function viewDivisasArqueoGetid(Response $response,$id)
    {
        $divisasArqueoGet = $this->divisasArqueoEntry->where(["ID_divisa_arqueo"=>$id])->get();
        return $this->customResponse->is200Response($response,$divisasArqueoGet);
    }
    public function deleteDivisaArqueo(Response $response,$id)
    {
        $this->divisasEntry->where(["ID_divisa_arqueo"=>$id])->delete();
        $responseMessage = "La divisa fue eliminada exitosamente";
        return $this->customResponse->is200Response($response,$responseMessage);
    }

         public function createDivisaArqueo(Request $request,Response $response)
    {

        $data = json_decode($request->getBody(),true);

        $this->validator->validate($request,[
                "Id_arqueo"=>v::notEmpty(),
                "Valor"=>v::notEmpty(),
                "Tipo_divisa"=>v::notEmpty(),
                "Nombre_divisa"=>v::notEmpty(),
                "Cantidad"=>v::notEmpty(),
                "Total_divisa"=>v::notEmpty()
            ]); 
       	 

       if($this->validator->failed())
       {
           $responseMessage = $this->validator->errors;
           return $this->customResponse->is400Response($response,$responseMessage);
       }
 try{
       
        $divisArqueoEntry = new DivisasArqueoEntry;
        $divisArqueoEntry->Id_arqueo     =   $data['Id_arqueo'];
        $divisArqueoEntry->valor         =   $data['Valor'];
        $divisArqueoEntry->tipo_divisa   =   $data['Tipo_divisa'];
        $divisArqueoEntry->nom_divisa    =   $data['Nombre_divisa'];
        $divisArqueoEntry->cantidad      =   $data['Cantidad'];
        $divisArqueoEntry->total_divisa  =   $data['Total_divisa'];
        $divisArqueoEntry->save();

        $responseMessage = array('msg'
         => "Arqueo divisa se guardo correctamente",'id' 
         => $divisArqueoEntry->id);

        return $this->customResponse->is200Response($response,$responseMessage);

        }catch(Exception $err){

        $responseMessage = array("err" => $err->getMessage());
        return $this->customResponse->is400Response($response,$responseMessage);
       }
    }

      public function editarDivisaArqueo(Request $request,Response $response,$id)
    {
         $data = json_decode($request->getBody(),true);

        $this->validator->validate($request,[
                "Id_arqueo"=>v::notEmpty(),
                "Valor"=>v::notEmpty(),
                "Tipo_divisa"=>v::notEmpty(),
                "Nombre_divisa"=>v::notEmpty(),
                "Cantidad"=>v::notEmpty(),
                "Total_divisa"=>v::notEmpty()
        ]);

        if($this->validator->failed())
        {
            $responseMessage = $this->validator->errors;
            return $this->customResponse->is400Response($response,$responseMessage);
        }

        try{
        $divisArqueoEntry = DivisasArqueoEntry::find($id);
        $divisArqueoEntry->Id_arqueo     =   $data['Id_arqueo'];
        $divisArqueoEntry->valor         =   $data['Valor'];
        $divisArqueoEntry->tipo_divisa   =   $data['Tipo_divisa'];
        $divisArqueoEntry->nom_divisa    =   $data['Nombre_divisa'];
        $divisArqueoEntry->cantidad      =   $data['Cantidad'];
        $divisArqueoEntry->total_divisa  =   $data['Total_divisa'];
        $divisArqueoEntry->save();

        $responseMessage = array('msg' 
        => "Arqueo divisa editado correctamente",'id' 
        => $id);

        return $this->customResponse->is200Response($response,$responseMessage);
        
        }catch(Exception $err){
        $responseMessage = array("err" => $err->getMessage());
        return $this->customResponse->is400Response($response,$responseMessage);
       }
    }
     /* FIN TABLA DIVISARQUEO */

}
