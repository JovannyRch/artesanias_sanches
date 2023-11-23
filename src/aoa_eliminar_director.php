<?php

function eliminarDirector($db, $id)
{
    $db->query("DELETE FROM tbldirector WHERE id_director = $id");
}
