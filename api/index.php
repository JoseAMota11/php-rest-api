<?php

require('C:\xampp\htdocs\php_api\api\controllers\user.controller.php');

$db = new DatabaseConnection('localhost', 'atldb', 'root');
$query = new DatabaseQuery($db->getConnection());
$method = $_SERVER['REQUEST_METHOD'];
$id = isset($_SERVER['PATH_INFO']) ? str_replace('/', '', $_SERVER['PATH_INFO']) : null;

switch ($method) {
  case 'GET':
    if ($id) {
      echo getOneUser($query, $id);
    } else {
      echo getAllUsers($query);
    }
    break;

  case 'POST':
    echo setUser($query);
    break;

  case 'PUT':
    echo updateUser($query, $id);
    break;

  case 'DELETE':
    echo deleteUser($query, $id);
    break;

  default:
    http_response_code(405);
    echo json_encode(['message' => "$method method is not allowed"]);
    break;
}
