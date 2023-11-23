<?php
include_once 'aoa_conexion.php';
class Database extends Conexion
{

    function __construct()
    {
        parent::__construct();
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
        $stmt = $this->db->prepare($sql);
        return $stmt->execute();
    }


    function utf8_converter($array)
    {
        array_walk_recursive($array, function (&$item, $key) {
            if (!mb_detect_encoding($item, 'utf-8', true)) {
                $item = utf8_encode($item);
            }
        });

        return $array;
    }
}
