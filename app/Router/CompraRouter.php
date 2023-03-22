<?php
use Slim\App;
use App\Controllers\CompraController;

return function (App $app) {
     $app->group("/api",function ($app) {
         $app->group("/compras", function ($app) {
                $app->get("/view-compra", [CompraController::class, "viewCompras"]);
                $app->get("/view-compra/{id}", [CompraController::class, "viewComprasId"]);
          });
        });
};