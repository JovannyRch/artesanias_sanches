<?php

require 'Model.php';
session_start();

$modelo = new Model();

$id = $_GET['id'];
$ticket = $modelo->registro("SELECT DATE_FORMAT(fecha, '%d/%m/%Y') fecha,total,id_usuario from tickets where id = $id");
$total = $ticket['total'];
$fecha = $ticket['fecha'];
$id_usuario = $ticket['id_usuario'];

$nombreUsuario = $modelo->registro("SELECT nombre from usuarios where id = $id_usuario")['nombre'];

$productos = $modelo->arreglo("SELECT productos.nombre,pt.precio precioR,pt.cantidad from productos inner join productos_ticket pt on pt.id_producto = productos.id where pt.id_ticket = $id");

// Require composer autoload

// Create an instance of the class:

$html = "
";

$html .= "
    <table class='table' style='width:100%; text-align:center'>
    <tr  >
        <td class='titulo-azul'><b>N</b></td>
        <td class='titulo-azul'><b>Producto</b></td>
        <td class='titulo-azul'><b>Subtotal</b></td>
        <td class='titulo-azul'><b>Total</b></td>
    </tr>
 
";

foreach ($productos as $registro) {
    $subtotal = intval($registro['precioR']) / intval($registro['cantidad']);
    $html .= "<tr>";
    $html .= "<td>";
    $html .=  $registro['cantidad'];
    $html .= "</td>";

    $html .= "<td>";
    $html .=  $registro['nombre'];
    $html .= "</td>";

    $html .= "<td>$";
    $html .=  $subtotal;
    $html .= "</td>";

    $html .= "<td>$";
    $html .=  $registro['precioR'];
    $html .= "</td>";



    $html .= "</tr>";
}


$html .= "</table> <br>

<p style='text-align: right'>
    <b>
    Total: $$total
    </b>
</p>


<p >
    <h5 style='text-align: center'>
        NOTA: Asiste a la tienda con este ticket de compra<br> para la entrega de tus productos
    </h5>
</p>
<hr>
</body>
</html>
";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de compra</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap-4.3.1.css" rel="stylesheet">
    <script src="assets/js/vue.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
</head>

<body>

    <body style="background-color:#f9f2e7;">
        <div id="app" class="container" style="padding: 10% 5%;">


            <div class="container">
                <div class="alert alert-success text-center" role="alert">
                    ¡Gracias por su compra!
                    <div>
                        <b>Ticket #<?= $id ?></b>
                    </div>
                </div>
                <div class="text-center">
                    <a href="index.php" type="button" class="btn btn-link">
                        Regresar al inicio
                    </a>
                </div>
                <div style="height: 100px"></div>
                <h4>Productos</h4>
                <?= $html ?>
            </div>



        </div>


        </footer>

        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery-3.3.1.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap-4.3.1.js"></script>
        <script src="assets/js/notify.js"></script>


    </body>
</body>

</html>