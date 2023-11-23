<?php
include_once('./db.php');

$db = new Database();

function eliminarCliente($db, $id)
{
    $db->query("DELETE FROM tblcliente WHERE id_cliente = $id");
}


if (isset($_POST['id_cliente'])) {

    $id = $_POST['id_cliente'];
    eliminarCliente($db, $id);
    header('Location: ./AOAAdminInicio.php');
}
