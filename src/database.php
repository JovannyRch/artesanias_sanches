<?php

$server = 'db';
$username = 'root';
$password = '';
$database = 'tienda_virtual2';

try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}
