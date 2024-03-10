<?php

namespace App;

use Exception;

class Router
{
  protected $routes = [];

  // Função privada para servir como base para a get e post
  private function addRoute($route, $controller, $action, $method)
  {
    // Adiciona uma nova rota ao array
    $this->routes[$method][$route] = ['controller' => $controller, 'action' => $action];
  }

  public function get($route, $controller, $action)
  {
    $this->addRoute($route, $controller, $action, "GET");
  }

  public function post($route, $controller, $action)
  {
    $this->addRoute($route, $controller, $action, "POST");
  }

  public function dispatch()
  {
    try {
      // Pega a URI e Método da Request
      $uri = strtok($_SERVER['REQUEST_URI'], '?');
      $method =  $_SERVER['REQUEST_METHOD'];

      // Verifica se a rota existe no array de $routes
      if (array_key_exists($uri, $this->routes[$method])) {
        // Caso exista, busca pelo controller e método
        $controller = $this->routes[$method][$uri]['controller'];
        $action = $this->routes[$method][$uri]['action'];

        // Cria uma nova instância do controller e chama o método
        $controller = new $controller();
        $controller->$action();
      } else {
        include "Views/404.php";
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }
}
