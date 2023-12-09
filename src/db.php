<?php

class Database
{
    public $db;

    function __construct()
    {
        $server = 'db';
        $username = 'root';
        $database = 'nomina';
        $password = '';


        /* $server = 'localhost';
        $username = 'zsdluflx_nomina';
        $database = 'zsdluflx_nomina';
        $password = 'BvBCpTaMp'; */

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

    function busrcarEmpleado($search_term)
    {

        $id = $search_term;
        $search_term = "'%" . $search_term . "%'";

        $results = [];

        if ($this->isNumber($id)) {
            $sql = "SELECT e.*, c.nombre as cargo FROM empleados e inner join cargos c on e.cargo_id = c.id WHERE e.id = $id";
            $response = $this->array($sql);

            foreach ($response as $key => $value) {
                $results[] = $value;
            }
        }

        $sql = "SELECT e.*, c.nombre as cargo FROM empleados e inner join cargos c on e.cargo_id = c.id WHERe e.nombre LIKE $search_term OR e.paterno LIKE $search_term OR e.materno LIKE $search_term";

        $response = $this->array($sql);

        foreach ($response as $key => $value) {
            $results[] = $value;
        }

        return $results;
    }

    function isNumber($number)
    {
        return is_numeric($number);
    }
}
