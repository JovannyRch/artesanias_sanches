<?php

function editarDirector($db, $id, $nombre, $paterno, $materno, $nacionalidad, $fechaNacimiento)
{
    $db->query("UPDATE tbldirector SET nombre = '$nombre', ap_paterno = '$paterno', ap_materno = '$materno', nacionalidad = '$nacionalidad', fecha_nacimiento = '$fechaNacimiento' WHERE id_director = $id");
}
