<?php

abstract class RouteSwitch
{
  protected function home()
  {
    require __DIR__ . '/views/home.php';
  }

  protected function indexCustomers()
  {
    require __DIR__ . '/views/customers/index.php';
  }

  protected function notFound()
  {
    require __DIR__ . '/views/not_found.php';
  }
}
