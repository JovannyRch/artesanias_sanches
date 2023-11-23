<?php

function leerDirectores($db)
{
    $directores = $db->array("SELECT * FROM tbldirector");
    return $directores;
}
