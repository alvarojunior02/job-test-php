<?php

namespace App\Models;

use App\Database;
use DateTime;
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
  private $connection;

  // Construtor, ao instânciar um novo objeto Customer
  public function __construct($cpf, $name, $email)
  {
    $this->cpf = $cpf;
    $this->name = $name;
    $this->email = $email;
    $this->createdAt = new DateTime();
  }

  // Métodos da classe
  public static function findAll()
  {
    $database = new Database;
    $connection = $database->getConnection();

    $sql = "SELECT * FROM customers ORDER BY name ASC;";

    $result = $connection->query($sql);

    $data = $result->fetchAll(PDO::FETCH_ASSOC);

    return $data;
  }

  public static function findOne(int $id)
  {
    $database = new Database;
    $connection = $database->getConnection();

    $sql = "SELECT * FROM customers WHERE id = " . $id . " LIMIT = 1;";

    $result = $connection->query($sql);

    $data = $result->fetchAll(PDO::FETCH_ASSOC);

    return $data;
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
      echo 'Erro ao importar planilha (.csv): ' .  $e->getMessage();
    }
  }

  // Encapsulamento (Getters and Setters)
  public function getId(): int
  {
    return $this->id;
  }

  public function getCpf(): string
  {
    return $this->cpf;
  }

  public function setCpf(string $cpf): void
  {
    $this->cpf = $cpf;
  }

  public function setName(): string
  {
    return $this->name;
  }

  public function getName(string $name): void
  {
    $this->name = $name;
  }

  public function setEmail(string $email): void
  {
    $this->email = $email;
  }

  public function getEmail(): string
  {
    return $this->email;
  }

  public function setCreatedAt(DateTime $createdAt): void
  {
    $this->createdAt = $createdAt;
  }

  public function getCreatedAt(): string
  {
    return date_format($this->createdAt, 'd/m/Y H:i:s');
  }
}
