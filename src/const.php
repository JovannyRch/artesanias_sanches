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
        "title" => "Gestión de Empleados",
        "url" => "empleados.php"
    ],
    [
        "title" => "Cálculo de Nómina",
        "url" => "nomina.php"
    ],
    [
        "title" => "Reportes",
        "url" => "reportes.php"
    ]
];


$status = ["Activo", "Licencia", "Vacaciones", "Incapacidad", "Suspendido", "Baja Voluntaria", "Baja Involuntaria", "Jubilado", "Fallecido"];


function formatCurrency($value)
{
    return "$" . number_format($value, 2, '.', ',');
}
