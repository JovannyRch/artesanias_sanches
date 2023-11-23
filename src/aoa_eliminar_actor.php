<?php

function eliminarActor($db, $id)
{
    $db->query("DELETE FROM tblactor WHERE id_actor = $id");
}
