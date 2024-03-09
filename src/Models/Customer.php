<?php

namespace App\Models;

use DateTime;
use DateTimeInterface;
use Lib\Database;

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
    $this->createdAt = date("Y-m-d H:i:s");
  }

  // Métodos da classe
  public function findAll()
  {
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
