<?php

function eliminarPelicula($db, $id)
{
    $db->query("DELETE FROM tbl_pelicula WHERE id_pelicula = $id");
}
