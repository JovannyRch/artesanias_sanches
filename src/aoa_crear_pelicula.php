<?php

function crearPelicula($db, $id_categoria, $id_actor1, $id_actor2, $nombre, $pais, $sinopsis, $anio_lanzamiento, $clasificacion, $imagen, $director)
{
    $db->query("INSERT INTO tbl_pelicula (id_categoria, id_actor1, id_actor2, nombre, pais, sinopsis, anio_lanzamiento, clasificacion, imagen, id_director) VALUES ($id_categoria, $id_actor1, $id_actor2, '$nombre', '$pais', '$sinopsis', '$anio_lanzamiento', '$clasificacion', '$imagen', $director)");
}
