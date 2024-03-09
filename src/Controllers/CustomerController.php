<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Customer;
use Exception;

class CustomerController extends Controller
{
  public function index()
  {
    Customer::class
    $this->render('customer/index');
  }

  public function importCsv()
  {
    try {
      $file = $_FILES['file_csv']; // Recupera arquivo .csv do form

      if (!isset($file)) { // Verifica se foi selecionado algum arquivo
        throw new Exception('Selecione um arquivo!');
      }

      if ($file['type'] != "text/csv") { // Verifica se o tipo é .csv
        throw new Exception('Arquivo não permitido!');
      }

      $file_data = fopen($file['tmp_name'], "r");

      while ($line = fgetcsv($file_data, 1000, ",")) {
        print_r($line);
        echo "<br>";
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }
}
