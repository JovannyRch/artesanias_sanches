<?php

class Database
{
    public $db;

    function __construct()
    {
        $server = 'db';
        $username = 'root';
        $password = '';
        $database = 'nomina';
        try {
            $this->db = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
        } catch (PDOException $e) {
            die('Connection Failed: ' . $e->getMessage());
        }
    }

    function checkConnection()
    {
        if ($this->db) {
            return true;
        } else {
            return false;
        }
    }



    function lastId()
    {
        return $this->row("SELECT LAST_INSERT_ID() id");
    }



    function row($sql)
    {
        $resultado = $this->db->prepare($sql);
        if ($resultado->execute()) {
            $arreglo =  $this->utf8_converter($resultado->fetchAll(PDO::FETCH_ASSOC));
            if (sizeof($arreglo) > 0) {
                return $arreglo[0];
            } else return null;
        } else return null;
    }

    function array($sql)
    {
        $resultados = $this->db->prepare($sql);
        if ($resultados->execute()) {
            return $this->utf8_converter($resultados->fetchAll(PDO::FETCH_ASSOC));
        } else return null;
    }

    function query($sql)
    {
        try {
            $this->db->query($sql);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    function utf8_converter($array)
    {
        /* array_walk_recursive($array, function (&$item, $key) {
            if (!mb_detect_encoding($item, 'utf-8', true)) {
                $item = utf8_encode($item);
            }
        });
 */
        return $array;
    }
}
