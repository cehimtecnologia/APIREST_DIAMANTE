<?php

namespace  App\Controllers;

use App\Models\InventarioEntry;
use App\Response\CustomResponse;
use App\Validation\Validator;

use Respect\Validation\Validator as v;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class InventarioController
{
     protected $customResponse;
    protected $validator;
    protected $inventarioEntry;

    public function __construct(){
        $this->customResponse = new CustomResponse();
        $this->validator = new Validator();
        $this->inventarioEntry = new InventarioEntry();
    }
        public function viewSucursalGet(Response $response)
    {
        $sucursalGet = $this->inventarioEntry->get();
        return $this->customResponse->is200Response($response,$sucursalGet);
    }

      public function viewInventarioGetIdproducto(Response $response,$id)
    {
        $arqueoGet = $this->inventarioEntry->where(["idproducto"=>$id])->get();
        return $this->customResponse->is200Response($response,$arqueoGet);
    }

     public function deleteInventario(Response $response,$id)
    {
        $this->inventarioEntry->where(["id_inventario"=>$id])->delete();
        $responseMessage = "La sucursal fue eliminada exitosamente";
        return $this->customResponse->is200Response($response,$responseMessage);
    }
}
