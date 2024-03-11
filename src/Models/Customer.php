<?php

namespace App\Models;

use App\Database;
use DateTime;
use Exception;
use PDO;
use PDOException;

class Customer
{
  // Atributos da classe
  private int $id;
  private string $cpf;
  private string $name;
  private string $email;
  private DateTime $createdAt;

  public function __construct($cpf, $name, $email)
  {
    $this->cpf = $cpf;
    $this->name = $name;
    $this->email = $email;
    $this->createdAt = new DateTime();
  }

  // Métodos para manipular banco de dados
  public static function findAll()
  {
    $database = new Database;
    $connection = $database->getConnection();

    $sql = "SELECT * FROM customers ORDER BY name ASC;";

    $result = $connection->query($sql);

    $data = $result->fetchAll(PDO::FETCH_ASSOC);

    return $data;
  }

  public static function findOne($id)
  {
    $database = new Database;
    $connection = $database->getConnection();

    $sql = "SELECT * FROM customers WHERE id = " . $id . " LIMIT 1";

    $result = $connection->query($sql);

    $data = $result->fetchAll(PDO::FETCH_ASSOC);

    return $data[0];
  }

  public function store()
  {
    try {
      $database = new Database;
      $connection = $database->getConnection();

      $sql = "INSERT INTO customers (cpf, name, email) VALUES (:cpf, :name, :email);";

      $statement = $connection->prepare($sql);
      $statement->bindParam(':cpf', $this->cpf);
      $statement->bindParam(':name', $this->name);
      $statement->bindParam(':email', $this->email);

      $statement->execute();
      return $statement->rowCount();
    } catch (PDOException $e) {
      echo 'Erro ao salvar registro no banco de dados: ' .  $e->getMessage();
    }
  }

  public static function update(int $id, string $name, string $email)
  {
    $database = new Database;
    $connection = $database->getConnection();

    $sqlSelect = "SELECT * FROM customers WHERE id = " . $id . " LIMIT 1;";

    $result = $connection->query($sqlSelect);

    $data = $result->fetchAll(PDO::FETCH_ASSOC);

    if (isset($data)) {
      $sqlUpdate = "UPDATE customers SET name = :name, email = :email WHERE id = :id;";

      $statement = $connection->prepare($sqlUpdate);
      $statement->bindParam(':name', $name);
      $statement->bindParam(':email', $email);
      $statement->bindParam(':id', $id);

      $statement->execute();
      return $statement->rowCount();
    } else {
      throw new Exception("Cliente não encontrado", 404);
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
