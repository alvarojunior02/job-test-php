<?php

namespace App;

use PDO;

class Database
{
  private ?PDO $pdo = null;

  public function __construct(
    private string $host,
    private string $port,
    private string $dbname,
    private string $user,
    private string $password
  ) {
  }

  public function getConnection(): PDO
  {
    if ($this->pdo === null) {

      $dataSouceName = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8;port={$this->port}";

      $this->pdo = new PDO($dataSouceName, $this->user, $this->password);
    }

    return $this->pdo;
  }
}
