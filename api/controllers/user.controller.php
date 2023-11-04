<?php

require('C:\xampp\htdocs\php_api\api\models\user.model.php');

$db = new DatabaseConnection("localhost", "atldb", "root");
$query = new DatabaseQuery($db->getConnection());
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "GET") {
  $result = $query->query("SELECT * FROM users");
  header("Content-Type:application/json");
  print_r(json_encode($result->fetchAll()));
}
