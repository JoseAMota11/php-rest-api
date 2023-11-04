<?php

require('C:\xampp\htdocs\php_api\api\models\user.model.php');
require('C:\xampp\htdocs\php_api\libs\validations.php');

header("Content-Type:application/json");

function getAllUsers(DatabaseQuery $query)
{
  try {
    $sql = "SELECT * FROM users";
    $result = $query->query($sql);
    $rows = $result->fetchAll();

    if (count($rows) > 0) {
      return json_encode($rows);
    }

    return json_encode(['message' => 'The database is empty']);
  } catch (PDOException $e) {
    http_response_code(500);
    json_encode(['message' => $e->getMessage()]);
  }
}

function getOneUser(DatabaseQuery $query, int $id)
{
  try {
    $sql = "SELECT * FROM users WHERE id = :id";
    $result = $query->prepare($sql);
    $result->bindValue(':id', $id, PDO::PARAM_INT);
    $result->execute();

    $rows = $result->fetch();

    if ($rows) {
      return json_encode($rows);
    }

    return json_encode(['message' => "There is not row with id ($id)"]);
  } catch (PDOException $e) {
    http_response_code(500);
    json_encode(['message' => $e->getMessage()]);
  }
}

function setUser(DatabaseQuery $query)
{
  [$name, $lastName, $email, $phoneNumbers] = validateUser();

  try {
    $sql = "INSERT INTO users (name, last_name, email, phone_numbers) VALUES (:name, :last_name, :email, :phone_numbers)";
    $result = $query->prepare($sql);

    $result->bindValue(':name', $name, PDO::PARAM_STR);
    $result->bindValue(':last_name', $lastName, PDO::PARAM_STR);
    $result->bindValue(':email', $email, PDO::PARAM_STR);
    $result->bindValue(':phone_numbers', $phoneNumbers, PDO::PARAM_STR);

    $result->execute();

    http_response_code(201);
    return json_encode(['message' => 'Data received and processed successfully']);
  } catch (PDOException $e) {
    http_response_code(500);
    return json_encode(['message' => $e->getMessage()]);
  }
}

function updateUser(DatabaseQuery $query, int $id)
{

  [$name, $lastName, $email, $phoneNumbers] = validateUser();

  try {
    $sql = "UPDATE users SET name = :name, last_name = :last_name, email = :email, phone_numbers = :phone_numbers WHERE id = :id";
    $result = $query->prepare($sql);

    $result->bindValue(':name', $name, PDO::PARAM_STR);
    $result->bindValue(':last_name', $lastName, PDO::PARAM_STR);
    $result->bindValue(':email', $email, PDO::PARAM_STR);
    $result->bindValue(':phone_numbers', $phoneNumbers, PDO::PARAM_STR);
    $result->bindValue(':id', $id, PDO::PARAM_INT);

    $result->execute();

    http_response_code(204);
  } catch (PDOException $e) {
    http_response_code(500);
    json_encode(['message' => $e->getMessage()]);
  }
}

function deleteUser(DatabaseQuery $query, int $id)
{
  try {
    $sql = "DELETE FROM users WHERE id = :id";
    $result = $query->prepare($sql);

    $result->bindValue(':id', $id, PDO::PARAM_INT);
    $result->execute();

    http_response_code(204);
  } catch (PDOException $e) {
    http_response_code(500);
    json_encode(['message' => $e->getMessage()]);
  }
}
