<?php
function crearCliente($db, $nombre, $paterno, $materno, $rfc, $curp, $membresia)
{
    $fecha_termino = $membresia == "mensual" ? "DATE_ADD(NOW(), INTERVAL 1 MONTH)" : "DATE_ADD(NOW(), INTERVAL 1 YEAR)";

    $db->query("INSERT INTO tblcliente
        (nombre, ap_paterno, ap_materno, rfc, curp, tipo_membresia, fecha_inicio_membresia, fecha_termino_membresia)
        values (
            '$nombre',
            '$paterno',
            '$materno',
            '$rfc',
            '$curp',
            '$membresia',
            NOW(),
            $fecha_termino
        )
     ");
}
