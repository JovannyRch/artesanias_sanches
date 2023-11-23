<?php

function editarPelicula($db, $id_pelicula,  $id_categoria, $id_actor1, $id_actor2, $nombre, $pais, $sinopsis, $anio_lanzamiento, $clasificacion, $imagen, $id_director)
{
    $db->query("UPDATE tbl_pelicula SET id_categoria = '$id_categoria', id_actor1 = '$id_actor1', id_actor2 = '$id_actor2', nombre = '$nombre', pais = '$pais', sinopsis = '$sinopsis', anio_lanzamiento = '$anio_lanzamiento', clasificacion = '$clasificacion', imagen = '$imagen', id_director = $id_director WHERE id_pelicula = $id_pelicula");
}
