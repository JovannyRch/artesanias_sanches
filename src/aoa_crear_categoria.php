<?php

function crearCategoria($db, $nombre)
{
    $db->query("INSERT INTO tblcategoria (nombre) VALUES ('$nombre')");
}
