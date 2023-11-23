<?php

function validarEliminacionActor($db, $id)
{
    $peliculas = $db->array("SELECT * FROM tbl_pelicula WHERE id_actor1 = $id or id_actor2 = $id");
    if (count($peliculas) > 0) {
        return false;
    } else {
        return true;
    }
}
