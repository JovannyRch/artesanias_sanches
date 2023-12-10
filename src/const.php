<?php


$menu = [
    [
        "title" => "Dashboard",
        "url" => "dashboard.php"
    ],
    [
        "title" => "Departamentos",
        "url" => "departamentos.php"
    ],
    [
        "title" => "Cargos",
        "url" => "cargos.php"
    ],
    [
        "title" => "Empleados",
        "url" => "empleados.php"
    ],
    [
        "title" => "Nóminas",
        "url" => "nominas.php"
    ],
    [
        "title" => "Cálculo de Nómina",
        "url" => "calculo_nomina.php"
    ],
    /*   [
        "title" => "Reportes",
        "url" => "reportes.php"
    ] */
];


$status = ["Activo", "Licencia", "Vacaciones", "Incapacidad", "Suspendido", "Baja Voluntaria", "Baja Involuntaria", "Jubilado", "Fallecido"];


function formatCurrency($value)
{
    return "$" . number_format($value, 2, '.', ',');
}

function formatDate($date)
{
    return date("d/m/Y", strtotime($date));
}
