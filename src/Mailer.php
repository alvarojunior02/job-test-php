<?php

namespace App;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
  private PHPMailer $phpMailer;

  public function __construct()
  {
    try {
      // Instancia o PHPMailer
      $this->phpMailer = new PHPMailer(true);

      // Configura o servidor de envio de e-mail
      $this->phpMailer->isSMTP();
      $this->phpMailer->Host = $_ENV['MAIL_HOST'];
      $this->phpMailer->SMTPAuth = true;
      $this->phpMailer->Port = $_ENV['MAIL_PORT'];
      $this->phpMailer->Username = $_ENV['MAIL_USERNAME'];
      $this->phpMailer->Password = $_ENV['MAIL_PASSWORD'];

      // Adiciona a origem, e-mail que estará enviando
      $this->phpMailer->setFrom('admin@lojamagica.com', 'Mailer');
    } catch (Exception $e) {
      echo "Erro ao iniciar o Mailer: {$this->phpMailer->ErrorInfo}";
    }
  }

  public function setRecipient(string $email, string $name)
  {
    $this->phpMailer->addAddress($email, $name);
  }

  public function setContent(string $subject, string $body)
  {
    $this->phpMailer->isHTML(true);
    $this->phpMailer->Subject = $subject;
    $this->phpMailer->Body = $body;
    $this->phpMailer->CharSet = "UTF-8";
  }

  public function send()
  {
    try {
      $this->phpMailer->send();
    } catch (Exception $e) {
      echo "Erro ao enviar o e-mail: {$this->phpMailer->ErrorInfo}";
    }
  }
}
