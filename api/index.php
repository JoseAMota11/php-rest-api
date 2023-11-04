<?php

require('C:\xampp\htdocs\php_api\api\controllers\user.controller.php');

$db = new DatabaseConnection("localhost", "atldb", "root");
$query = new DatabaseQuery($db->getConnection());
$method = $_SERVER["REQUEST_METHOD"];

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
