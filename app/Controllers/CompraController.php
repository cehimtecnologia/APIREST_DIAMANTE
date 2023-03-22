<?php

namespace  App\Controllers;

use App\Models\ComprasEntry;
use App\Models\ComprasProductoEntry;
use App\Models\TrasladosEntry;
use App\Response\CustomResponse;
use App\Woocomerce\WooResponse;
use App\Validation\Validator;

use Respect\Validation\Validator as v;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


class CompraController
{
    
    protected $customResponse;
    protected $wooResponse;
    protected $validator;
    protected $comprasEntry;
    protected $comprasProductoEntry;
    protected $trasladosEntry;

          public function __construct()
    {
        $this->customResponse = new CustomResponse();
        $this->wooResponse = new WooResponse();
        $this->validator = new Validator();
        $this->comprasEntry = new ComprasEntry();
        $this->comprasProductoEntry = new ComprasProductoEntry();
        $this->trasladosEntry = new TrasladosEntry(); 
    }

    /* INICIO PROCESO MODELO AVATAR CLIENTE */
public function viewCompras(Response $response)
    {
        $comprasGet =$this->wooResponse->woocommerce('products','GET');
        return $this->customResponse->is200Response($response,$comprasGet);
    }


public function viewComprasId(Response $response, $id)
    {
        $comprasGet =$this->wooResponse->woocommerce('products/'.$id,'GET');
        return $this->customResponse->is200Response($response,$comprasGet);
    }
}
