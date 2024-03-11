<?php

namespace App\Models;

use App\Database;
use DateTime;
use PDO;
use PDOException;

class Email
{
  // Atributos da classe
  private int $id;
  private int $customer_id;
  private string $subject;
  private string $message;
  private DateTime $createdAt;

  public function __construct($customer_id, $subject, $message)
  {
    $this->customer_id = $customer_id;
    $this->subject = $subject;
    $this->message = $message;
    $this->createdAt = new DateTime();
  }

  // Métodos para manipular banco de dados
  public static function findManyByCustomerId($customer_id)
  {
    $database = new Database;
    $connection = $database->getConnection();

    $sql = "SELECT * FROM emails WHERE customer_id = " . $customer_id . " ORDER BY created_at DESC; ";

    $result = $connection->query($sql);

    $data = $result->fetchAll(PDO::FETCH_ASSOC);

    return $data;
  }

  public static function findOne($id)
  {
    $database = new Database;
    $connection = $database->getConnection();

    $sql = "SELECT * FROM emails WHERE id = " . $id . " LIMIT 1";

    $result = $connection->query($sql);

    $data = $result->fetchAll(PDO::FETCH_ASSOC);

    return $data[0];
  }

  public function store()
  {
    try {
      $database = new Database;
      $connection = $database->getConnection();

      $sql = "INSERT INTO emails (customer_id, subject, message) VALUES (:customer_id, :subject, :message);";

      $statement = $connection->prepare($sql);
      $statement->bindParam(':customer_id', $this->customer_id);
      $statement->bindParam(':subject', $this->subject);
      $statement->bindParam(':message', $this->message);

      $statement->execute();
      return $statement->rowCount();
    } catch (PDOException $e) {
      echo 'Erro ao salvar registro no banco de dados: ' .  $e->getMessage();
    }
  }

  // Getters
  public function getId(): int
  {
    return $this->id;
  }

  public function getCreatedAt(): string
  {
    return date_format($this->createdAt, 'd/m/Y H:i:s');
  }
}
