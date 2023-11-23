<?php

function leerCategorias($db)
{
    $categorias = $db->array("SELECT * FROM tblcategoria");
    return $categorias;
}
