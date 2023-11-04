<?php

function validateUser()
{
  $resultDecode = json_decode(file_get_contents('php://input'), true);

  $name = $resultDecode['name'];
  $lastName = $resultDecode['last_name'];
  $email = $resultDecode['email'];
  $phoneNumbers = $resultDecode['phone_numbers'];

  if (empty($name) || empty($lastName) || empty($email) || empty($phoneNumbers)) {
    http_response_code(400);
    echo json_encode(['message' => 'All the fields are required']);
    die();
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['message' => 'Invalid email format']);
    die();
  }
  if (json_encode($phoneNumbers) === false) {
    http_response_code(400);
    echo json_encode(['message' => '\'phone_numbers\' should be provided in a valid JSON format']);
    die();
  }
  if (!is_string($name)) {
    http_response_code(400);
    echo json_encode(['message' => '\'name\' must be an string']);
    die();
  }
  if (!is_string($lastName)) {
    http_response_code(400);
    echo json_encode(['message' => '\'last_name\' must be an string']);
    die();
  }
  if (!is_string($email)) {
    http_response_code(400);
    echo json_encode(['message' => '\'email\' must be an string']);
    die();
  }

  return array($name, $lastName, $email, json_encode($phoneNumbers));
}
