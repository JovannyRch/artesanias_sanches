<?php


function editarCliente($db, $id, $nombre, $paterno, $materno, $rfc, $curp, $membresia)
{
    $fecha_termino = $membresia == "mensual" ? "DATE_ADD(NOW(), INTERVAL 1 MONTH)" : "DATE_ADD(NOW(), INTERVAL 1 YEAR)";

    $db->query("UPDATE tblcliente
        SET nombre = '$nombre',
            ap_paterno = '$paterno',
            ap_materno = '$materno',
            rfc = '$rfc',
            curp = '$curp',
            tipo_membresia = '$membresia',
            fecha_inicio_membresia = NOW(),
            fecha_termino_membresia = $fecha_termino
        WHERE id_cliente = $id
     ");
}
