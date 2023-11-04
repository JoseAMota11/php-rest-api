<?php

require("./models/user.model.php");

$db = new DatabaseConnection("localhost", "atldb", "root");
$query = new DatabaseQuery($db->getConnection());
$result = $query->query("SELECT * FROM users");

while ($row = $result->fetch()) {
  echo $row['name'] . "<br>";
  echo $row['last_name'] . "<br>";
  echo $row['email'] . "<br>";
  echo $row['phone_numbers'] . "<br>";
}
