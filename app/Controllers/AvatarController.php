<?php

namespace  App\Controllers;

use App\Models\AvatarempleadoEntry;
use App\Models\AvatarclienteEntry;
use App\Response\CustomResponse;
use App\Validation\Validator;

use Respect\Validation\Exceptions\Exception;
use Respect\Validation\Validator as v;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class AvatarController
{
    protected $customResponse;
    protected $validator;
    protected $avatarempleadoEntry;
    protected $avatarclienteEntry;

      public function __construct()
    {
        $this->customResponse = new CustomResponse();
        $this->validator = new Validator();
        $this->avatarempleadoEntry = new AvatarempleadoEntry();
        $this->avatarclienteEntry = new AvatarclienteEntry();
    }

/* INICIO PROCESO MODELO AVATAR CLIENTE */
public function viewAvatarCGet(Response $response)
    {
        $avatarclienteGet = $this->avatarclienteEntry->get();
        return $this->customResponse->is200Response($response,$avatarclienteGet);
    }

      public function viewAvatarCGetid(Response $response,$id)
    {
        $avatarclienteGet = $this->avatarclienteEntry->where(["ID_avatar"=>$id])->get();
        return $this->customResponse->is200Response($response,$avatarclienteGet);
    }

     public function deleteAvatarC(Response $response,$id)
    {
        $this->avatarclienteEntry->where(["ID_avatar"=>$id])->delete();
        $responseMessage = "El avatar fue eliminado exitosamente";
        return $this->customResponse->is200Response($response,$responseMessage);
    }


   public function createAvatarC(Request $request,Response $response)
    {
        $data = json_decode($request->getBody(),true);

        $this->validator->validate($request,[
                "Id_Cliente"=>v::notEmpty(),
                "Fotoimg"=>v::notEmpty()
        ]); 

       if($this->validator->failed())
       {
           $responseMessage = $this->validator->errors;
           return $this->customResponse->is400Response($response,$responseMessage);
       }

       try{

        $AvatarEntry = new AvatarclienteEntry;
        $AvatarEntry->Id_Cliente     =  $data['Id_Cliente'];
        $AvatarEntry->fotoimg        =  $data['Fotoimg'];
        $AvatarEntry->tipoimg        =  '.jpg';
        $AvatarEntry->tamanoimg      =  '20';
        $AvatarEntry->save();

        $responseMessage = array('msg' 
        => "Avatar guardado correctamente",'id' 
        => $AvatarEntry->id);

        return $this->customResponse->is200Response($response,$responseMessage);

        }catch(Exception $err){

        $responseMessage = array("err" => $err->getMessage());
        return $this->customResponse->is400Response($response,$responseMessage);

       }
    }
    
 public function editarAvatarC(Request $request,Response $response,$id)
    {
        $data = json_decode($request->getBody(),true);

        $this->validator->validate($request,[
                "Id_Cliente"=>v::notEmpty(),
                "Fotoimg"=>v::notEmpty()
        ]);

        if($this->validator->failed())
        {
            $responseMessage = $this->validator->errors;
            return $this->customResponse->is400Response($response,$responseMessage);
        }

        try{

        $AvatarEntry = AvatarclienteEntry::find($id);
        $AvatarEntry->Id_Cliente     =  $data['Id_Cliente'];
        $AvatarEntry->fotoimg        =  $data['Fotoimg'];
        $AvatarEntry->tipoimg        =  '.jpg';
        $AvatarEntry->tamanoimg      =  '20';
        $AvatarEntry->save();

        $responseMessage = array('msg'
         => "Avatar Corregido correctamente",'id'
         => $id);

        return $this->customResponse->is200Response($response,$responseMessage);

        }catch(Exception $err){
        $responseMessage = array("err" => $err->getMessage());
        return $this->customResponse->is400Response($response,$responseMessage);
       }
    }
/* FIN PROCESO MODELO AVATAR CLIENTE */

/* INICIO PROCESO MODELO AVATAR EMPLEADO */
public function viewAvatarEGet(Response $response)
    {
        $avatarempleadoGet = $this->avatarempleadoEntry->get();
        return $this->customResponse->is200Response($response,$avatarempleadoGet);
    }

      public function viewAvatarEGetid(Response $response,$id)
    {
        $avatarempleadoGet = $this->avatarempleadoEntry->where(["ID_avatar"=>$id])->get();
        return $this->customResponse->is200Response($response,$avatarempleadoGet);
    }

     public function deleteAvatarE(Response $response,$id)
    {
        $this->avatarempleadoEntry->where(["ID_avatar"=>$id])->delete();
        $responseMessage = "El avatar fue eliminado exitosamente";
        return $this->customResponse->is200Response($response,$responseMessage);
    }


   public function createAvatarE(Request $request,Response $response)
    {
        $data = json_decode($request->getBody(),true);

        $this->validator->validate($request,[
                "Id_empleado"=>v::notEmpty(),
                "Fotoimg"=>v::notEmpty()
        ]); 

       if($this->validator->failed())
       {
           $responseMessage = $this->validator->errors;
           return $this->customResponse->is400Response($response,$responseMessage);
       }

       try{

        $AvatarEntry = new AvatarempleadoEntry;
        $AvatarEntry->Id_empleado     =  $data['Id_empleado'];
        $AvatarEntry->fotoimg        =  $data['Fotoimg'];
        $AvatarEntry->tipoimg        =  '.jpg';
        $AvatarEntry->tamanoimg      =  '20';
        $AvatarEntry->save();

        $responseMessage = array('msg' 
        => "Avatar guardado correctamente",'id' 
        => $AvatarEntry->id);

        return $this->customResponse->is200Response($response,$responseMessage);

        }catch(Exception $err){

        $responseMessage = array("err" => $err->getMessage());
        return $this->customResponse->is400Response($response,$responseMessage);

       }
    }
    
 public function editarAvatarE(Request $request,Response $response,$id)
    {
        $data = json_decode($request->getBody(),true);

        $this->validator->validate($request,[
                "Id_empleado"=>v::notEmpty(),
                "Fotoimg"=>v::notEmpty()
        ]);

        if($this->validator->failed())
        {
            $responseMessage = $this->validator->errors;
            return $this->customResponse->is400Response($response,$responseMessage);
        }

        try{

        $AvatarEntry = AvatarclienteEntry::find($id);
        $AvatarEntry->Id_empleado     =  $data['Id_empleado'];
        $AvatarEntry->fotoimg        =  $data['Fotoimg'];
        $AvatarEntry->tipoimg        =  '.jpg';
        $AvatarEntry->tamanoimg      =  '20';
        $AvatarEntry->save();

        $responseMessage = array('msg'
         => "Avatar Corregido correctamente",'id'
         => $id);

        return $this->customResponse->is200Response($response,$responseMessage);

        }catch(Exception $err){
        $responseMessage = array("err" => $err->getMessage());
        return $this->customResponse->is400Response($response,$responseMessage);
       }
    }
/* FIN PROCESO MODELO AVATAR EMPLEADO */
}
