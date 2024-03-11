<?php

namespace App\Controllers;

use App\Controller;
use App\Mailer;
use App\Models\Customer;
use App\Models\Email;
use App\Models\Order;
use DateTime;
use Exception;

class OrderController extends Controller
{
  public function index()
  {
    $orders = Order::findAll();

    $data = array(
      "orders" => $orders,
    );

    $this->render(view: 'order/index', data: $data);
  }

  public function importXml()
  {
    try {
      $file = $_FILES['file_xml']; // Recupera arquivo .xml do form

      if (!isset($file)) { // Verifica se foi selecionado algum arquivo
        throw new Exception('Selecione um arquivo!');
      }

      if ($file['type'] != "text/xml") { // Verifica se o tipo é .xml
        throw new Exception('Tipo de arquivo não permitido!');
      }

      $xml = simplexml_load_file($file['tmp_name']);

      $message = "<p>Nome da Empresa: " . $xml->Company->Name . "</p>";
      $message .= "<p>CNPJ: " . $xml->Company->CNPJ . "</p>";
      $message .= "<p>Email: " . $xml->Company->Email . "</p>";
      $message .= "<p>Data do pedido: " . date_format(new DateTime($xml->Order->Date), 'd/m/Y') . "</p>";
      $message .= "<p>Valor: R$ " . number_format(str_replace(',', '.', str_replace('.', '', $xml->Order->Amount)), 2, ',', '.') . "</p>";
      $message .= "<p>Descrição: " . $xml->Order->Description . "</p>";

      $_SESSION['imported_xml_message'] = $message;
      header("Location: /pedidos");
    } catch (Exception $e) {
      echo 'Erro ao importar arquivo (.xml): ' . $e->getMessage();
    }
  }

  public function create()
  {
    $customers = Customer::findAll();

    $data = array(
      'customers' => $customers
    );

    $this->render(view: 'order/create', data: $data);
  }

  public function store()
  {
    try {
      if (isset($_POST['customer_id']) && isset($_POST['amount']) && isset($_POST['status'])) {
        if (intval($_POST['customer_id']) == 0) {
          throw new Exception("Escolha um cliente para vincular ao pedido");
        }

        $customer = Customer::findOne($_POST['customer_id']);

        $order = new Order(intval($_POST['customer_id']), floatval(str_replace(',', '.', str_replace('.', '', $_POST['amount']))), $_POST['status']);
        $order->store();

        $mailer = new Mailer();
        $mailer->setRecipient(email: $customer['email'], name: $customer['name']);

        $subject = "Novo pedido registrado em seu nome na Loja Mágica!";
        $message = "
          <h1>Novo pedido registrado em seu nome na Loja Mágica!</h1>
          <p>Pedido no valor de: R$ " . $_POST['amount'] . "</p>
          <p>Status atual: " . $_POST['status'] . "</p>
          <p>Fique de olho no seu e-mail para mais informações.</p>
          <p>Atenciosamente, Loja Mágica de Tecnologia.</p>
        ";

        $mailer->setContent(subject: $subject, body: nl2br($message));
        $mailer->send();

        $email = new Email($_POST['customer_id'], $subject, nl2br($message));
        $email->store();

        $_SESSION['crud_message'] = "Novo pedido registrado com sucesso! Um e-mail foi enviado ao cliente.";
        header("Location: /pedidos");
      } else {
        throw new Exception("Não pode ter campos em branco!");
      }
    } catch (Exception $e) {
      echo "Erro ao registrar pedido: " . $e->getMessage();
    }
  }

  public function edit()
  {
    try {
      if (isset($_REQUEST['id'])) {
        $order = Order::findOne($_REQUEST['id']);
        $customers = Customer::findAll();
        $data = [
          'order' => $order,
          'customers' => $customers
        ];

        $this->render(view: 'order/edit', data: $data);
      } else {
        throw new Exception('ID do pedido não encontrado!');
      }
      die();
    } catch (Exception $e) {
      echo 'Erro ao editar pedido: ' . $e->getMessage();
    }
  }

  public function update()
  {
    try {
      if (isset($_POST['status'])) {
        $oldOrder = Order::findOne($_REQUEST['order_id']);

        if ($oldOrder['status'] != $_POST['status']) {
          Order::update(id: $_POST['order_id'], status: $_POST['status']);

          $customer = Customer::findOne($_POST['customer_id']);

          $mailer = new Mailer();
          $mailer->setRecipient(email: $customer['email'], name: $customer['name']);

          $subject = "Status do seu pedido na Loja Mágica foi atualizado!";
          $message = "
            <h1>Acabamos de identificar uma alteração no status do seu pedido!</h1>
            <p>Pedido no valor de: R$ " . number_format($oldOrder['amount'], 2, ',', '.') . "</p>
            <p>Status anteterior: " . $oldOrder['status'] . "</p>
            <p>Status novo: " . $_POST['status'] . "</p>
            <p>Fique de olho no seu e-mail para mais informações.</p>
            <p>Atenciosamente, Loja Mágica de Tecnologia.</p>
          ";

          $mailer->setContent(subject: $subject, body: nl2br($message));
          $mailer->send();

          $email = new Email($_POST['customer_id'], $subject, nl2br($message));
          $email->store();

          $_SESSION['crud_message'] = "Status do pedido alterado com sucesso! Um e-mail foi enviado ao cliente.";
          header("Location: /pedidos");
        }
      } else {
        throw new Exception("Não pode ter campos em branco!");
      }
    } catch (Exception $e) {
      echo "Erro ao editar status do pedido: " . $e->getMessage();
    }
  }
}
