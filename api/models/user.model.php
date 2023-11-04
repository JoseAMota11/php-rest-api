<?php

class DatabaseConnection
{
  private $pdo;

  public function __construct(string $hostname, string $database, string $username, string $password = "")
  {
    try {
      $this->pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (PDOException $e) {
      die("Conexión fallida: " . $e->getMessage());
    }
  }

  public function getConnection()
  {
    return $this->pdo;
  }

  public function __destruct()
  {
    $this->pdo = null;
  }
}

class DatabaseQuery
{
  private $pdo;

  public function __construct(PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  public function query(string $sql)
  {
    return $this->pdo->query($sql);
  }

  public function prepare(string $sql)
  {
    return $this->pdo->prepare($sql);
  }
}
