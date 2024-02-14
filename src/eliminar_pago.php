<?php

session_start();


if (!isset($_SESSION['idUsuario'])) {
    header('Location: iniciar_sesion.php');
    exit;
}

if ($_SESSION['tipoUsuario'] !== 'PDC') {
    header('Location: consultar_pagos.php');
    exit;
}

$pdo = new PDO("mysql:host=db;dbname=pagos_escolares;charset=utf8;", 'root', '');
//$pdo = new PDO("mysql:host=localhost;dbname=auogesej_pagos;charset=utf8;", 'auogesej_pagos', 'DfCU4azC6');
$folio = $_GET['folio'];
$sql = "DELETE FROM PAGOS WHERE FolioPago = '$folio'";

$stm = $pdo->prepare($sql);
$stm->execute();

$pdo = null;


header('Location: consultar_pagos_pdc.php');
