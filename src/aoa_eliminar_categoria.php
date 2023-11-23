<?php

function eliminarCategoria($db, $id)
{
    $db->query("DELETE FROM tblcategoria WHERE id_categoria = $id");
}
