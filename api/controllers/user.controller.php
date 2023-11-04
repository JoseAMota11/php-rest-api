<?php

require('C:\xampp\htdocs\php_api\api\models\user.model.php');
require('C:\xampp\htdocs\php_api\libs\validations.php');

$db = new DatabaseConnection("localhost", "atldb", "root");
$query = new DatabaseQuery($db->getConnection());
$method = $_SERVER["REQUEST_METHOD"];
header("Content-Type:application/json");

switch ($method) {
  case 'GET':
    echo getAllUser($query);
    break;

  case 'POST':
    echo setAnUser($query);
    break;

  case 'PUT':

    break;

  case 'DELETE':

    break;

  default:
    echo json_encode(['message' => "$method method is not supported"]);
    break;
}

function getAllUser(DatabaseQuery $query)
{
  try {
    $result = $query->query("SELECT * FROM users");

    if ($result) {
      return json_encode($result->fetchAll());
    }
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
