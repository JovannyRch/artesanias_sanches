<?php

function crearActor($db, $nombre, $paterno, $materno, $nacionalidad, $fechaNacimiento)
{
    $db->query("INSERT INTO tblactor (nombre, ap_paterno,ap_materno, nacionalidad, fecha_nacimiento) VALUES ('$nombre', '$paterno', '$materno', '$nacionalidad', '$fechaNacimiento')");
}
