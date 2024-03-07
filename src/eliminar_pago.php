<?php

require_once 'db.php';
session_start();


if (!isset($_SESSION['idUsuario'])) {
    header('Location: iniciar_sesion.php');
    exit;
}

if ($_SESSION['tipoUsuario'] !== 'PDC') {
    header('Location: consultar_pagos.php');
    exit;
}

$db = new Database();

$folio = $_GET['folio'];
$sql = "DELETE FROM PAGOS WHERE FolioPago = '$folio'";

$db->query($sql);


header('Location: consultar_pagos_pdc.php');
