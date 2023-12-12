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

    case 'eliminar_nomina':
        $id = $_POST['id'];
        $respuesta = $db->eliminarNomina($id);
        responder($respuesta);
        break;

    case 'eliminar_cargo':
        $id = $_POST['id'];
        $respuesta = $db->eliminarCargo($id);
        responder($respuesta);
        break;
    case 'eliminar_departamento':
        $id = $_POST['id'];
        $respuesta = $db->eliminarDepartamento($id);
        responder($respuesta);
        break;
    case 'eliminar_empleado':
        $id = $_POST['id'];
        $respuesta = $db->eliminarEmpleado($id);
        responder($respuesta);
        break;
    default:
        echo json_encode(array('success' => 0, 'error' => 'Servicio no encontrado:' . $servicio));
        break;
}
