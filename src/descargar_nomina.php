<?php
require 'tfpdf.php';
include_once './const.php';
include_once './db.php';


session_start();


class PDF extends tFPDF
{
    // Encabezado del documento
    function Header()
    {
        // Logo
        $this->Image('assets/logo.png', 10, 6, 30); // Asegúrate de tener la imagen 'logo.png' en la ruta correcta
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Mover a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(30, 10, 'SIMAQ', 0, 1, 'C');
    }

    // Pie de página
    function Footer()
    {
        // Posición a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    // Tabla simple
    function TablaSimple($header, $data)
    {
        // Cabecera
        foreach ($header as $col)
            $this->Cell(90, 7, $col, 1);
        $this->Ln();
        // Datos
        foreach ($data as $row) {
            foreach ($row as $col)
                $this->Cell(90, 6, $col, 1);
            $this->Ln();
        }
    }
}




if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$db = new Database();


$id = $_GET['id'];

$check = $db->existeNomina($id);

if (!$check) {
    header("Location: index.php");
    exit;
}


$nomina = $db->getCalculoNomina($id);

$datos_empleado = $nomina['empleado'];
$empleado = $datos_empleado['nombre'] . " " . $datos_empleado['paterno'] . " " . $datos_empleado['materno'];

$anio_registro = date("Y", strtotime($nomina['fecha_procesamiento']));

$periodo_inicio = date("Y-m-d", strtotime($nomina['periodo_inicio']));
$periodo_fin = date("Y-m-d", strtotime($nomina['periodo_fin']));

$subtotal = $nomina['salario_bruto'] + $nomina['total_asignaciones'];

$asignaciones = json_decode($nomina['asignaciones'], true);
$deducciones = json_decode($nomina['deducciones'], true);

$id_empleado = $datos_empleado['id'];
$id_nomina = $nomina['id'];

// Crear instancia del documento
$pdf = new PDF();
$pdf->AddPage();

// Agregar y definir la fuente
$pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
$pdf->AddFont('DejaVu', 'B', 'DejaVuSans-Bold.ttf', true);


$pdf->Ln(5);

$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(0, 7, "ID Nómina: $id_nomina", 0, 1);
$pdf->Cell(0, 7, "ID Empleado: $id_empleado", 0, 1);

$pdf->SetFont('DejaVu', 'B', 10);
$pdf->Cell(0, 7, "$empleado", 0, 1);


$pdf->SetFont('DejaVu', '', 10);
$pdf->Ln(5);
$header = array('RFC', $datos_empleado['rfc']);
$data = array(
    array('CURP', $datos_empleado['curp']),
    array('Puesto', $datos_empleado['cargo']),
    array('Inicio periodo', $periodo_inicio),
    array('Fin periodo', $periodo_fin),
    array('Días de pago', $nomina['dias_de_pago']),
);

if ($nomina['horas_extras'] != 0) {
    array_push($data, array('Horas extras', $nomina['horas_extras']));
}

if ($nomina['precio_por_horas_extra'] != 0) {
    array_push($data, array('Precio por hora extra', formatCurrency($nomina['precio_por_horas_extra'])));
}

// Añadir una tabla al documento
$pdf->TablaSimple($header, $data);
// Add space

if (count($asignaciones) != 0) {
    $pdf->Ln(5);

    //Add percepciones table
    $pdf->SetFont('DejaVu', 'B', 10);
    $pdf->Cell(0, 7, "Percepciones", 0, 1);
    $pdf->SetFont('DejaVu', '', 10);

    $header = array('Concepto', 'Importe');
    $data = array();


    foreach ($asignaciones as $asignacion) {
        array_push($data, array($asignacion['concepto'], formatCurrency($asignacion['valor'])));
    }


    $pdf->TablaSimple($header, $data);

    //Add total
    $pdf->Ln(5);
    $pdf->SetFont('DejaVu', 'B', 10);
    $pdf->Cell(0, 7, "Total percepciones: " . formatCurrency($nomina['total_asignaciones']), 0, 1);
    $pdf->Ln(5);
}


if (count($deducciones) != 0) {
    //Add deducciones table

    $pdf->Ln(5);
    $pdf->SetFont('DejaVu', 'B', 10);
    $pdf->Cell(0, 7, "Deducciones", 0, 1);
    $pdf->SetFont('DejaVu', '', 10);

    $header = array('Concepto', 'Importe');
    $data = array();

    foreach ($deducciones as $deduccion) {
        array_push($data, array($deduccion['concepto'], formatCurrency($deduccion['valor'])));
    }

    $pdf->TablaSimple($header, $data);

    //Add total
    $pdf->Ln(5);
    $pdf->SetFont('DejaVu', 'B', 10);
    $pdf->Cell(0, 7, "Total deducciones: " . formatCurrency($nomina['total_deducciones']), 0, 1);
}
//Add sueldo neto

$pdf->Ln(15);
$pdf->SetFont('DejaVu', 'B', 10);



$header = array('Sueldo bruto', formatCurrency($nomina['salario_bruto']));
$data = array(
    array('Percepciones', "+" . formatCurrency($nomina['total_asignaciones'])),
    array('Deducciones', "-" . formatCurrency($nomina['total_deducciones'])),
    array('', ''),
    array('Sueldo neto', formatCurrency($nomina['salario_neto'])),
);

// Añadir una tabla al documento´
$pdf->TablaSimple($header, $data);


$nombre_empleado_archivo = str_replace(" ", "_", $empleado);


//Set file name
$filename = "nomina_$id_nomina";
$filename .= "_$nombre_empleado_archivo.pdf";


// Salida del documento
$pdf->Output($filename, 'D');
