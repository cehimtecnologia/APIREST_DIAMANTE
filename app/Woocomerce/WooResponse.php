<?php
namespace  App\Woocomerce;
use Automattic\WooCommerce\Client;

class WooResponse
{
 public function woocommerce($Objeto,$HTTP)
    {
        $woocommerce = new Client(
                'https://www.diamante.cehim.co/',
                'ck_9243aa1c313f90964e4f5c53b4d871181bcf0bf2',
                'cs_e4cd4805aea94ee1e4a2ecfe41a15a90301ca73f',
                [
                    'wp_api' => true,
                    'version' => 'wc/v3'
                ]
          );
       
      if($HTTP=='GET'){
       return  $woocommerce->get($Objeto);
      }elseif($HTTP == 'POST'){
        //return  $woocommerce->post();
      }elseif($HTTP == 'PUT'){
        // return  $woocommerce->put($Objeto);
      }elseif($HTTP == 'DELETE'){
           return  $woocommerce->delete($Objeto);
      }
    }
}