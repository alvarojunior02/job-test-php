<?php

namespace App\Models;

use App\Database;
use DateTime;
use Exception;
use PDO;
use PDOException;

class Order
{
  // Atributos da classe
  private int $id;
  private int $customer_id;
  private float $amount;
  private string $status;
  private DateTime $createdAt;

  public function __construct($customer_id, $amount, $status)
  {
    $this->customer_id = $customer_id;
    $this->amount = $amount;
    $this->status = $status;
    $this->createdAt = new DateTime();
  }

  // Métodos para manipular banco de dados
  public static function findAll()
  {
    $database = new Database;
    $connection = $database->getConnection();

    $sql = "SELECT * FROM orders as ord INNER JOIN customers as c ON c.id = ord.customer_id ORDER BY ord.created_at DESC;";

    $result = $connection->query($sql);

    $data = $result->fetchAll(PDO::FETCH_ASSOC);

    return $data;
  }

  public static function findManyByCustomerId($customer_id)
  {
    $database = new Database;
    $connection = $database->getConnection();

    $sql = "SELECT * FROM orders  WHERE orders.customer_id = " . $customer_id . " ORDER BY orders.created_at DESC;";

    $result = $connection->query($sql);

    $data = $result->fetchAll(PDO::FETCH_ASSOC);

    return $data;
  }

  public static function findOne($id)
  {
    $database = new Database;
    $connection = $database->getConnection();

    $sql = "SELECT * FROM orders WHERE id = " . $id . " LIMIT 1";

    $result = $connection->query($sql);

    $data = $result->fetchAll(PDO::FETCH_ASSOC);

    return $data[0];
  }

  public function store()
  {
    try {
      $database = new Database;
      $connection = $database->getConnection();

      $sql = "INSERT INTO orders (customer_id, amount, status) VALUES (:customer_id, :amount, :status);";

      $statement = $connection->prepare($sql);
      $statement->bindParam(':customer_id', $this->customer_id);
      $statement->bindParam(':amount', $this->amount);
      $statement->bindParam(':status', $this->status);

      $statement->execute();
      return $statement->rowCount();
    } catch (PDOException $e) {
      echo 'Erro ao salvar registro no banco de dados: ' .  $e->getMessage();
    }
  }

  public static function update(int $id, string $status)
  {
    $database = new Database;
    $connection = $database->getConnection();

    $sqlSelect = "SELECT * FROM orders WHERE id = " . $id . " LIMIT 1;";

    $result = $connection->query($sqlSelect);

    $data = $result->fetchAll(PDO::FETCH_ASSOC);

    if (isset($data)) {
      $sqlUpdate = "UPDATE orders SET status = :status WHERE id = :id;";

      $statement = $connection->prepare($sqlUpdate);
      $statement->bindParam(':status', $status);
      $statement->bindParam(':id', $id);

      $statement->execute();
      return $statement->rowCount();
    } else {
      throw new Exception("Pedido não encontrado", 404);
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
