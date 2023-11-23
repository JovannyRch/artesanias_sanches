<?php


function editarCategoria($db, $id, $nombre)
{
    $db->query("UPDATE tblcategoria SET nombre = '$nombre' WHERE id_categoria = $id");
}
