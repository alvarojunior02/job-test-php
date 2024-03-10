<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Customer;
use Exception;

class CustomerController extends Controller
{
  public function index()
  {
    $customers = Customer::findAll();
    $data = [
      'customers' => $customers
    ];

    $this->render(view: 'customer/index', data: $data);
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


      $firstLine = true;
      $rows_imported = 0;
      $rows = 0;
      while ($line = fgetcsv($file_data, 1000, ",")) {
        if ($firstLine) { // Ignorar cabeçalho da planilha
          $firstLine = false;
          continue;
        }

        $rows++;
        $customer = new Customer($line[0], $line[1], $line[2]);
        $rowCount = $customer->store();

        if ($rowCount) {
          $rows_imported++;
        }
      }
      $_SESSION['imported_csv_message'] = "$rows_imported registro(s) importados de $rows registro(s) encontrados.";
      header("Location: /clientes");
    } catch (Exception $e) {
      echo 'Erro ao importar planilha (.csv): ' . $e->getMessage();
    }
  }
}
