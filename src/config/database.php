<?php

$server = 'localhost';
$username = 'id21406878_user';
$password = 'wGcg2VSnoLvCXyx@';
$database = 'id21406878_tienda';

try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}
