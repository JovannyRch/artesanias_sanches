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

// Get the folio from the URL
$initialFolio = $_GET['folio'];

//Get form data

$folio = $_POST['folio'];
$fecha = $_POST['fecha'];
$concepto = $_POST['concepto'];
$monto = $_POST['monto'];
$mesPagado = $_POST['mes'];

$pdo = new PDO("mysql:host=db;dbname=pagos_escolares;charset=utf8;", 'root', '');
//$pdo = new PDO("mysql:host=localhost;dbname=auogesej_pagos;charset=utf8;", 'auogesej_pagos', 'DfCU4azC6');
$sql = "UPDATE PAGOS SET FolioPago='$folio', MesPagado = '$mesPagado', FechaPago = '$fecha', Concepto = '$concepto', Monto = '$monto' WHERE FolioPago = '$initialFolio'";
$stm = $pdo->prepare($sql);
$stm->execute();



header('Location: consultar_pagos_pdc.php');
