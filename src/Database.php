<?php

namespace App;

use Exception;
use PDO;
use PDOException;

class Database
{
  private ?PDO $pdo = null;
  private string $host;
  private string $port;
  private string $dbname;
  private string $user;
  private string $password;

  public function __construct()
  {
    $this->host = $_ENV['DB_HOST'];
    $this->port = $_ENV['DB_PORT'];
    $this->dbname = $_ENV['DB_NAME'];
    $this->user = $_ENV['DB_USER'];
    $this->password = $_ENV['DB_PASSWORD'];
  }

  public function getConnection(): PDO
  {
    if ($this->pdo === null) {
      try {
        $dataSouceName = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8;port={$this->port}";

        $this->pdo = new PDO($dataSouceName, $this->user, $this->password);

        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
        echo "Conexão com banco falhou: " . $e->getMessage();
      }
    }

    return $this->pdo;
  }
}
