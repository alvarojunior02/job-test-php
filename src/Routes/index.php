<?php

use App\Controllers\CustomerController;
use App\Controllers\HomeController;
use App\Router;

$router = new Router;

$router->get("/", HomeController::class, "index");

$router->get("/clientes", CustomerController::class, "index");
$router->post("/clientes/import", CustomerController::class, "importCsv");

$router->dispatch();
