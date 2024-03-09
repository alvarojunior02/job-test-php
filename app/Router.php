
<?php

require_once 'RouterSwitch.php';

class Router extends RouteSwitch
{
  public function run(string $requestUri)
  {
    // Remove o '/' do início da Uri
    $route = substr($requestUri, 1);

    // 
    switch ($route) {
      case '':
        $this->home();
        break;
      case 'clientes':
        $this->indexCustomers();
        break;
      default:
        $this->notFound();
        break;
    }
  }
}
