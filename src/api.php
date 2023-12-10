<?php

require './db.php';


$db = new Database();

$servicio = $_POST['servicio'];

function responder($respuesta)
{
    echo json_encode($respuesta);
}


switch ($servicio) {
    case 'buscarEmpleado':
        $busqueda = $_POST['search'];
        $respuesta = $db->busrcarEmpleado($busqueda);
        responder($respuesta);
        break;

    case 'guardarNomina':
        $data = $_POST['data'];
        $respuesta = $db->guardarNomina($data);
        responder($respuesta);
        break;
    default:
        echo json_encode(array('success' => 0, 'error' => 'Servicio no encontrado:' . $servicio));
        break;
}
