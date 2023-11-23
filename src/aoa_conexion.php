<?php

class Conexion // Clase de conexión
{
    public $db; // Variable de conexión

    function __construct() // Constructor de la clase
    {
        $server = 'db';
        $username = 'root';
        $password = '';
        $database = 'pelisnow_db';
        try {
            $this->db = new PDO("mysql:host=$server;dbname=$database;", $username, $password); // Conexión a la base de datos
        } catch (PDOException $e) { // Si hay un error en la conexión, se muestra el mensaje
            die('Connection Failed: ' . $e->getMessage());
        }
    }
}
