<?php

function leerPeliculas($db)
{
    $peliculas = $db->array("SELECT 
        tbl_pelicula.*, 
        tblcategoria.nombre as categoria,
        tbldirector.nombre as director
        FROM tbl_pelicula inner join tblcategoria on tblcategoria.id_categoria = tbl_pelicula.id_categoria
        inner join tbldirector on tbldirector.id_director = tbl_pelicula.id_director
        ");

    foreach ($peliculas as &$pelicula) {
        $pelicula['actor1'] = $db->row("SELECT * FROM tblactor WHERE id_actor = {$pelicula['id_actor1']}");
        $pelicula['actor2'] = $db->row("SELECT * FROM tblactor WHERE id_actor = {$pelicula['id_actor2']}");
    }


    return $peliculas;
}
