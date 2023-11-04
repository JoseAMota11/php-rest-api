<?php

class UserModel
{
  private $pdo;

  public function __construct(string $hostname, string $database, string $username, string $password)
  {
    try {
      $this->pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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

class UserModelQuery
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
