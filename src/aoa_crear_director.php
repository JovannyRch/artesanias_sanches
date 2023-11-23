<?php

function crearDirector($db, $nombre, $paterno, $materno, $nacionalidad, $fechaNacimiento)
{
    $db->query("INSERT INTO tbldirector (nombre, ap_paterno,ap_materno, nacionalidad, fecha_nacimiento) VALUES ('$nombre', '$paterno', '$materno', '$nacionalidad', '$fechaNacimiento')");
}
