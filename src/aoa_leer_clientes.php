<?php

function leerClientes($db)
{
    $clientes = $db->array("SELECT * FROM tblcliente");
    return $clientes;
}
