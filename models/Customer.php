<?php

namespace models;

use DateTime;

class Customer
{
  // Atributos da classe
  private int $id;
  private string $cpf;
  private string $name;
  private string $email;
  private string $phone;
  private DateTime $createdAt;
  private DateTime $updatedAt;

  // Construtor, ao instânciar um novo objeto Customer
  public function __construct(array $data)
  {
    $this->cpf = $data['cpf'];
    $this->name = $data['name'];
    $this->email = $data['email'];
    $this->phone = $data['phone'];
    $this->createdAt = date("Y-m-d H:i:s");
    $this->updatedAt = date("Y-m-d H:i:s");
  }

  // Métodos da classe

  // Encapsulamento (Getters and Setters)

  public function getId()
  {
    $this->id;
  }

  public function getCpf(string $cpf)
  {
    $this->cpf = $cpf;
  }

  public function setCpf()
  {
    return $this->cpf;
  }

  public function setName(string $name)
  {
    $this->name = $name;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setEmail(string $email)
  {
    $this->email = $email;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function setPhone(string $phone)
  {
    $this->phone = $phone;
  }

  public function getPhone()
  {
    return $this->phone;
  }

  public function setCreatedAt(DateTime $createdAt)
  {
    $this->createdAt = $createdAt;
  }

  public function getCreatedAt()
  {
    return $this->createdAt;
  }

  public function setUpdatedAt(DateTime $updatedAt)
  {
    $this->updatedAt = $updatedAt;
  }

  public function getUpdatedAt()
  {
    return $this->updatedAt;
  }
}
