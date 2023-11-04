<?php

require('C:\xampp\htdocs\php_api\api\models\user.model.php');
require('C:\xampp\htdocs\php_api\libs\validations.php');

header("Content-Type:application/json");

function getAllUser(DatabaseQuery $query)
{
  try {
    $result = $query->query("SELECT * FROM users");
    $getAllUser = $result->fetchAll();

    if (count($getAllUser) > 0) {
      return json_encode($getAllUser);
    }

    return json_encode(['message' => 'The database is empty']);
  } catch (PDOException $e) {
    http_response_code(500);
    json_encode(['message' => $e->getMessage()]);
  }
}

function setAnUser(DatabaseQuery $query)
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
    json_encode(['message' => $e->getMessage()]);
  }
}
