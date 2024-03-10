<?php

require '../vendor/autoload.php';

session_start();

// Carrega as variáveis do .env para o $_ENV com o pacote Dotenv
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 1));
$dotenv->load();

$router = require '../src/Routes/index.php';
