<?php

namespace App\Controllers;

use App\Controller;
use App\Mailer;
use App\Models\Customer;
use App\Models\Email;
use App\Models\Order;
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

  public function show()
  {
    try {
      if (isset($_REQUEST['id'])) {
        $customer = Customer::findOne($_REQUEST['id']);
        $orders = Order::findManyByCustomerId($_REQUEST['id']);
        $emails = Email::findManyByCustomerId($_REQUEST['id']);
        $data = [
          'customer' => $customer,
          'orders' => $orders,
          'emails' => $emails
        ];

        $this->render(view: 'customer/show', data: $data);
      } else {
        throw new Exception('ID do cliente não encontrado!');
      }
      die();
    } catch (Exception $e) {
      echo 'Erro ao visualizar cliente: ' . $e->getMessage();
    }
  }

  public function importCsv()
  {
    try {
      $file = $_FILES['file_csv']; // Recupera arquivo .csv do form

      if (!isset($file)) { // Verifica se foi selecionado algum arquivo
        throw new Exception('Selecione um arquivo!');
      }

      if ($file['type'] != "text/csv") { // Verifica se o tipo é .csv
        throw new Exception('Tipo de arquivo não permitido!');
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

  public function create()
  {
    $this->render(view: 'customer/create');
  }

  private function validateCpf($cpf)
  {
    // Extrai somente os números
    $cpf = preg_replace('/[^0-9]/is', '', $cpf);

    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
      return false;
    }

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
      return false;
    }

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
      for ($d = 0, $c = 0; $c < $t; $c++) {
        $d += $cpf[$c] * (($t + 1) - $c);
      }
      $d = ((10 * $d) % 11) % 10;
      if ($cpf[$c] != $d) {
        return false;
      }
    }

    return true;
  }

  public function store()
  {
    try {
      if (isset($_POST['cpf']) && isset($_POST['name']) && isset($_POST['email'])) {
        if (!$this->validateCpf($_POST['cpf'])) {
          throw new Exception("CPF inválido!");
        }

        $customer = new Customer($_POST['cpf'], $_POST['name'], $_POST['email']);
        $customer->store();
        $_SESSION['crud_message'] = "Novo cliente cadastrado com sucesso!";
        header("Location: /clientes");
      } else {
        throw new Exception("Não pode ter campos em branco!");
      }
    } catch (Exception $e) {
      echo "Erro ao cadastrar novo cliente: " . $e->getMessage();
    }
  }

  public function edit()
  {
    try {
      if (isset($_REQUEST['id'])) {
        $customer = Customer::findOne($_REQUEST['id']);
        $data = [
          'customer' => $customer
        ];

        $this->render(view: 'customer/edit', data: $data);
      } else {
        throw new Exception('ID do cliente não encontrado!');
      }
      die();
    } catch (Exception $e) {
      echo 'Erro ao editar cliente: ' . $e->getMessage();
    }
  }

  public function update()
  {
    try {
      if (isset($_POST['name']) && isset($_POST['email'])) {
        Customer::update(id: intval($_REQUEST['id']), name: $_POST['name'], email: $_POST['email']);

        $_SESSION['crud_message'] = "Cliente alterado com sucesso!";
        header("Location: /clientes");
      } else {
        throw new Exception("Não pode ter campos em branco!");
      }
    } catch (Exception $e) {
      echo "Erro ao editar cliente: " . $e->getMessage();
    }
  }

  public function create_email()
  {
    try {
      if (isset($_REQUEST['id'])) {
        $customer = Customer::findOne($_REQUEST['id']);
        $data = array(
          'customer' => $customer
        );

        $this->render(view: 'customer/create_email', data: $data);
      } else {
        throw new Exception('ID do cliente não encontrado');
      }
    } catch (Exception $e) {
      echo 'Erro ao exibir tela de envio de e-mail: ' > $e->getMessage();
    }
  }

  public function send_email()
  {
    try {
      if (isset($_POST['customer_id']) || isset($_POST['subject']) || isset($_POST['message'])) {
        $customer = Customer::findOne($_POST['customer_id']);

        $mailer = new Mailer();
        $mailer->setRecipient(email: $customer['email'], name: $customer['name']);
        $mailer->setContent(subject: $_POST['subject'], body: nl2br($_POST['message']));
        $mailer->send();

        $email = new Email($_POST['customer_id'], $_POST['subject'], nl2br($_POST['message']));
        $email->store();

        $_SESSION['email_success'] = "E-mail enviado com sucesso!";
        header("Location: /clientes/info?id=" . $_POST['customer_id']);
      } else {
        throw new Exception("Estão faltando informações para compor o e-mail!");
      }
    } catch (Exception $e) {
      echo 'Erro ao enviar e-mail: ' . $e->getMessage();
    }
  }

  public function show_email()
  {
    try {
      $email = Email::findOne($_REQUEST['id']);

      $customer = Customer::findOne($email['customer_id']);

      $data = array(
        'email' => $email,
        'customer' => $customer
      );

      $this->render(view: 'customer/show_email', data: $data);
    } catch (Exception $e) {
      echo 'Erro ao buscar informações do e-mail: ' . $e->getMessage();
    }
  }
}
