<?php
use Slim\App;
use App\Controllers\AuthController;

return function (App $app) {
     $app->group("/api",function ($app) {
                $app->post("/auth/login", [AuthController::class, "Login"]);
          });
};