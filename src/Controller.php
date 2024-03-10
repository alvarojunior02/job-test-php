<?php

namespace App;

// Classe genérica de Controller que contém método para renderizar view
class Controller
{
  protected function render($view, $data = [])
  {
    $_SESSION["data"] = $data;

    include "Views/$view.php";
  }
}
