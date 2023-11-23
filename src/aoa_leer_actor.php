<?php

function leerActores($db)
{
    $actores = $db->array("SELECT * FROM tblactor");
    return $actores;
}
