<?php
namespace  App\Controllers;

use App\Models\ClientesEntry;
use App\Models\ReferidosEntry;
use App\Models\PuntosEntry;

use App\Response\CustomResponse;
use App\Validation\Validator;
use Respect\Validation\Exceptions\Exception;
use Respect\Validation\Validator as v;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ClienteController
{

    protected $customResponse;
    protected $validator;
    protected $clientesEntry;
    protected $referidosEntry;
    protected $puntosEntry;
  public function __construct()
    {
        $this->customResponse = new CustomResponse();
        $this->validator = new Validator();
        $this->clientesEntry = new ClientesEntry();
        $this->referidosEntry = new ReferidosEntry();
        $this->puntosEntry = new PuntosEntry();
    }
/* INICIO PROCESO TABLA CLIENTE */
    public function viewClienteGet(Response $response)
    {
        $arqueoGet = $this->clientesEntry->get();
        return $this->customResponse->is200Response($response,$arqueoGet);
    }

      public function viewClienteGetid(Response $response,$id)
    {
        $arqueoGet = $this->clientesEntry->where(["ID_Cliente"=>$id])->get();
        return $this->customResponse->is200Response($response,$arqueoGet);
    }

     public function deleteCliente(Response $response,$id)
    {
        $this->clientesEntry->where(["ID_Cliente"=>$id])->delete();
        $responseMessage = "el Cliente fue eliminado exitosamente";
        return $this->customResponse->is200Response($response,$responseMessage);
    }

    public function createCliente(Request $request,Response $response)
    {
        $data = json_decode($request->getBody(),true);

        $this->validator->validate($request,[
                "Id_Registro"=>v::notEmpty(),
                "Tipo_Documento"=>v::notEmpty(),
                "Documento"=>v::notEmpty(),
                "Nombres"=>v::notEmpty(),
                "Apellidos"=>v::notEmpty(),
                "Telefono"=>v::notEmpty(),
                "Email"=>v::notEmpty(),
                "Identificador"=>v::notEmpty(),
                "IdentificadorLider"=>v::notEmpty()
        ]); 

       if($this->validator->failed())
       {
           $responseMessage = $this->validator->errors;
           return $this->customResponse->is400Response($response,$responseMessage);
       }

       try{

        $ClienteEntry = new ClientesEntry;
        $ClienteEntry->Id_Registro         =   $data['Id_Registro'];
        $ClienteEntry->TipoDocumento       =   $data['TipoDocumento'];
        $ClienteEntry->NumeroDocumento     =   $data['Documento'];
        $ClienteEntry->Nombres             =   $data['Nombres'];
        $ClienteEntry->Apellidos           =   $data['Apellidos'];
        $ClienteEntry->Telefono            =   $data['Telefono'];
        $ClienteEntry->Email               =   $data['Email'];
        $ClienteEntry->Identificador       =   $data['Identificador'];
        $ClienteEntry->IdentificadorLider  =   $data['IdentificadorLider'];
        $ClienteEntry->save();

        $responseMessage = array('msg' 
        => "Cliente guardado correctamente",'id' 
        => $ClienteEntry->id);

        return $this->customResponse->is200Response($response,$responseMessage);

        }catch(Exception $err){

        $responseMessage = array("err" => $err->getMessage());
        return $this->customResponse->is400Response($response,$responseMessage);

       }
    }
    public function editarCliente(Request $request,Response $response,$id)
    {
        $data = json_decode($request->getBody(),true);

        $this->validator->validate($request,[
                "Id_Registro"=>v::notEmpty(),
                "Tipo_Documento"=>v::notEmpty(),
                "Documento"=>v::notEmpty(),
                "Nombres"=>v::notEmpty(),
                "Apellidos"=>v::notEmpty(),
                "Telefono"=>v::notEmpty(),
                "Email"=>v::notEmpty(),
                "Identificador"=>v::notEmpty(),
                "IdentificadorLider"=>v::notEmpty()
        ]);

        if($this->validator->failed())
        {
            $responseMessage = $this->validator->errors;
            return $this->customResponse->is400Response($response,$responseMessage);
        }

        try{

        $ClienteEntry = ClientesEntry::find($id);
        $ClienteEntry->Id_Registro         =   $data['Id_Registro'];
        $ClienteEntry->TipoDocumento       =   $data['TipoDocumento'];
        $ClienteEntry->NumeroDocumento     =   $data['NumeroDocumento'];
        $ClienteEntry->Nombres             =   $data['Nombres'];
        $ClienteEntry->Apellidos           =   $data['Apellidos'];
        $ClienteEntry->Telefono            =   $data['Telefono'];
        $ClienteEntry->Email               =   $data['Email'];
        $ClienteEntry->Identificador       =   $data['Identificador'];
        $ClienteEntry->IdentificadorLider  =   $data['IdentificadorLider'];
        $ClienteEntry->save();

        $responseMessage = array('msg'
         => "Cliente editado correctamente",'id'
         => $id);

        return $this->customResponse->is200Response($response,$responseMessage);

        }catch(Exception $err){
        $responseMessage = array("err" => $err->getMessage());
        return $this->customResponse->is400Response($response,$responseMessage);
       }
    }
/* FIN PROCESO MODELO CLIENTE */
/* INICIO PROCESO MODELO PUNTOS */
    public function viewPuntosGet(Response $response)
    {
        $puntosGet = $this->puntosEntry->get();
        return $this->customResponse->is200Response($response,$puntosGet);
    }

      public function viewPuntosGetid(Response $response,$id)
    {
        $puntosGet = $this->puntosEntry->where(["ID_Puntos"=>$id])->get();
        return $this->customResponse->is200Response($response,$puntosGet);
    }

     public function deletePuntos(Response $response,$id)
    {
        $this->puntosEntry->where(["ID_Puntos"=>$id])->delete();
        $responseMessage = "los Puntos fueron eliminado exitosamente";
        return $this->customResponse->is200Response($response,$responseMessage);
    }


   public function createPuntos(Request $request,Response $response)
    {
        $data = json_decode($request->getBody(),true);

        $this->validator->validate($request,[
                "Id_Cliente"=>v::notEmpty(),
                "Numero_puntos"=>v::notEmpty()
        ]); 

       if($this->validator->failed())
       {
           $responseMessage = $this->validator->errors;
           return $this->customResponse->is400Response($response,$responseMessage);
       }

       try{

        $PuntosEntry = new PuntosEntry;
        $PuntosEntry->ID_Cliente     =  $data['Id_Cliente'];
        $PuntosEntry->Numero_puntos  =  $data['Numero_puntos'];
        $PuntosEntry->save();

        $responseMessage = array('msg' 
        => "Puntos guardado correctamente",'id' 
        => $PuntosEntry->id);

        return $this->customResponse->is200Response($response,$responseMessage);

        }catch(Exception $err){

        $responseMessage = array("err" => $err->getMessage());
        return $this->customResponse->is400Response($response,$responseMessage);

       }
    }
  public function editarPuntos(Request $request,Response $response,$id)
    {
        $data = json_decode($request->getBody(),true);

        $this->validator->validate($request,[
                "Id_Cliente"=>v::notEmpty(),
                "Numero_puntos"=>v::notEmpty()
        ]);

        if($this->validator->failed())
        {
            $responseMessage = $this->validator->errors;
            return $this->customResponse->is400Response($response,$responseMessage);
        }

        try{

        $PuntosEntry = PuntosEntry::find($id);
        $PuntosEntry->ID_Cliente     =  $data['Id_Cliente'];
        $PuntosEntry->Numero_puntos  =  $data['Numero_puntos'];
        $PuntosEntry->save();

        $responseMessage = array('msg'
         => "Puntos Corregidos correctamente",'id'
         => $id);

        return $this->customResponse->is200Response($response,$responseMessage);

        }catch(Exception $err){
        $responseMessage = array("err" => $err->getMessage());
        return $this->customResponse->is400Response($response,$responseMessage);
       }
    }
/* FIN PROCESO MODELO PUNTOS */
/* INICIO PROCESO MODELO REFERIDOS */
    public function viewReferidosGet(Response $response)
    {
        $referidosGet = $this->referidosEntry->get();
        return $this->customResponse->is200Response($response,$referidosGet);
    }

      public function viewReferidosGetid(Response $response,$id)
    {
        $referidosGet = $this->referidosEntry->where(["ID_Referidos"=>$id])->get();
        return $this->customResponse->is200Response($response,$referidosGet);
    }

     public function deleteReferidos(Response $response,$id)
    {
        $this->referidosEntry->where(["ID_Referidos"=>$id])->delete();
        $responseMessage = "el Referido fueron eliminado exitosamente";
        return $this->customResponse->is200Response($response,$responseMessage);
    }


   public function createReferidos(Request $request,Response $response)
    {
        $data = json_decode($request->getBody(),true);

        $this->validator->validate($request,[
                "Id_Cliente"=>v::notEmpty(),
               // "Numero_puntos"=>v::notEmpty()
        ]); 

       if($this->validator->failed())
       {
           $responseMessage = $this->validator->errors;
           return $this->customResponse->is400Response($response,$responseMessage);
       }

       try{

        $ReferidoEntry = new ReferidosEntry;
        $ReferidoEntry->Id_Cliente     =  $data['Id_Cliente'];
        //$PuntosEntry->Numero_puntos  =  $data['Numero_puntos'];
        $ReferidoEntry->save();

        $responseMessage = array('msg' 
        => "Referido guardado correctamente",'id' 
        => $ReferidoEntry->id);

        return $this->customResponse->is200Response($response,$responseMessage);

        }catch(Exception $err){

        $responseMessage = array("err" => $err->getMessage());
        return $this->customResponse->is400Response($response,$responseMessage);

       }
    }
    
  public function editarReferidos(Request $request,Response $response,$id)
    {
        $data = json_decode($request->getBody(),true);

        $this->validator->validate($request,[
                "Id_Cliente"=>v::notEmpty(),
                //"Numero_puntos"=>v::notEmpty()
        ]);

        if($this->validator->failed())
        {
            $responseMessage = $this->validator->errors;
            return $this->customResponse->is400Response($response,$responseMessage);
        }

        try{

        $ReferidosEntry = ReferidosEntry::find($id);
        $ReferidosEntry->ID_Cliente     =  $data['Id_Cliente'];
        $ReferidosEntry->Numero_puntos  =  $data['Numero_puntos'];
        $ReferidosEntry->save();

        $responseMessage = array('msg'
         => "Referido Corregido correctamente",'id'
         => $id);

        return $this->customResponse->is200Response($response,$responseMessage);

        }catch(Exception $err){
        $responseMessage = array("err" => $err->getMessage());
        return $this->customResponse->is400Response($response,$responseMessage);
       }
    }
/* FIN PROCESO MODELO REFERIDOS */

}