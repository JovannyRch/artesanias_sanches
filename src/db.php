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

    function guardarNomina($data)
    {


        $asignaciones = isset($data['asignaciones']) ? json_encode($data['asignaciones']) :  '[]';
        $deducciones = isset($data['deducciones']) ? json_encode($data['deducciones']) :  '[]';


        $sql = "INSERT INTO calculo_nomina (empleado_id, periodo_inicio, periodo_fin, horas_extras, precio_por_horas_extra, asignaciones, deducciones, total_asignaciones, total_deducciones, comentarios, salario_neto, dias_de_pago, salario_bruto) VALUES (
            {$data['empleado_id']},
            '{$data['periodo_inicio']}',
            '{$data['periodo_fin']}',
            {$data['horas_extras']},
            {$data['precio_por_horas_extra']},
            '$asignaciones',
            '$deducciones',
            {$data['total_asignaciones']},
            {$data['total_deducciones']},
            '{$data['comentarios']}',
            {$data['salario_neto']},
            {$data['dias_de_pago']},
            {$data['salario_bruto']}
        )";

        $this->query($sql);

        $las_id = $this->lastId();

        return $las_id;
    }

    function isNumber($number)
    {
        return is_numeric($number);
    }


    function getCalculoNomina($id)
    {
        $sql = "SELECT * FROM calculo_nomina WHERE id = $id";
        $nomina = $this->row($sql);

        $sql = "SELECT e.*, c.nombre cargo FROM empleados e inner join cargos c on e.cargo_id = c.id WHERE e.id = {$nomina['empleado_id']} ";

        $empleado = $this->row($sql);

        $nomina['empleado'] = $empleado;

        return $nomina;
    }

    function existeNomina($id)
    {
        $sql = "SELECT * FROM calculo_nomina WHERE id = $id";
        $nomina = $this->row($sql);

        if ($nomina) {
            return true;
        } else {
            return false;
        }
    }
}
