<?php

use App\Controllers\CustomerController;
use App\Controllers\HomeController;
use App\Controllers\OrderController;
use App\Router;

$router = new Router;

// Home
$router->get("/", HomeController::class, "index");

// Rotas dos Clientes
$router->get("/clientes", CustomerController::class, "index");
$router->post("/clientes/import", CustomerController::class, "importCsv");
$router->get("/clientes/cadastrar", CustomerController::class, "create");
$router->post("/clientes/cadastrar", CustomerController::class, "store");
$router->get("/clientes/editar", CustomerController::class, "edit");
$router->post("/clientes/editar", CustomerController::class, "update");
$router->get("/clientes/info", CustomerController::class, "show");

$router->get("/clientes/email", CustomerController::class, "create_email");
$router->post("/clientes/email", CustomerController::class, "send_email");
$router->get("/clientes/email/info", CustomerController::class, "show_email");

// Rotas dos pedidos
$router->get("/pedidos", OrderController::class, "index");
$router->post("/pedidos/import", OrderController::class, "importXml");
$router->get("/pedidos/cadastrar", OrderController::class, "create");
$router->post("/pedidos/cadastrar", OrderController::class, "store");
$router->get("/pedidos/editar", OrderController::class, "edit");
$router->post("/pedidos/editar", OrderController::class, "update");

$router->dispatch();
