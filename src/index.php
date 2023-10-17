<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
   
  }else{
    header("Location: login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <style type="text/css">
.container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem;
        }

        .content-left {
            flex: 1;
            padding-right: 2rem;
        }

        .content-right {
            flex: 1;
            max-width: 50%;
        }

        .content-right img {
            max-width: 100%;
            height: auto;
        }

        .title {
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        .button {
            display: block;
            padding: 0.5rem 1rem;
            background-color: #333;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }
  </style>

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>INICIO</title>
  <!-- Bootstrap -->
  <link href="css/bootstrap-4.3.1.css" rel="stylesheet">
  <script src="assets/js/vue.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
</head>

<body style="background-color:#f9f2e7;">
  <div id="app">


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">PEÑALOZA</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item" v-for="categoria in categorias">
              <a class="nav-link" :href="'categoria.php?id='+categoria.id">{{categoria.nombre}}</a>
            </li>

            <li>
              <a href="carrito.php">
                <i class="fa fa-shopping-cart fa-2x"></i> {{cantidadCarrito}}
              </a>
            </li>


          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" value="<?=$_SESSION['email'];?>" type="text" readonly
              aria-label="Search">
            <a href="logout.php" class="btn btn-outline-success my-2 my-sm-0" type="button">Cerrar Sesión</a>
          </form>
        </div>
      </div>
    </nav>
    <br> <br>
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" height="300px" src="img/banner.png" alt="First slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" height="300px" src="img/banner2.png" alt="Second slide">
        </div>
      
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
   
   
    <div class="container" style="background-color:#faa191;">

   
        <div class="content-left">
            <div class="title">Bienvenido</div>
            La paletería y nevería nació de la pasión por ofrecer opciones refrescantes y deliciosas a la comunidad de Santiaguito Maxdá, Timilpan, Estado de México. Ahora planeamos llegar a muchos lugares...
            
            
            <a href="https://maps.app.goo.gl/uXutrykGCZuhkRvo7"  target="_blank" class="button">Conocer ubicación</a>
        </div>
        <div class="content-right">
            <img src="img/inicio.png" alt="Imagen de helado">
        </div>
    </div>


      </div>
      <?php require 'partials/footer.php' ?>
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

  <script>

    let app = new Vue({
      el: '#app',
      data: {
        productos: [],
        categorias: [],
        cantidadCarrito: 0,

        id_usuario: "<?=$_SESSION['user_id']?>"
      },
      created: function () {
        this.getCategorias();
        this.getProductos();
        this.fcantidadCarrito();
      },
      methods: {

        addCarrito(id_producto) {
          $.ajax({
            type: "POST",
            url: 'controladores/api.php',
            data: {
              servicio: "agregarCarrito",
              id_usuario: this.id_usuario,
              id_producto: id_producto
            },
            success: function (respuesta) {
              app.cantidadCarrito = parseInt(respuesta);
              $.notify(
                "Se ha agregado el producto a tu carrito", {
                position: "right top",
                className: "success"
              }
              );
            }
          });
        },

        fcantidadCarrito() {
          $.ajax({
            type: "POST",
            url: 'controladores/api.php',
            data: {
              servicio: "getCantidadCarrito",
              id_usuario: this.id_usuario
            },
            success: function (respuesta) {
              app.cantidadCarrito = parseInt(respuesta);
            }
          });

        },
        getProductos() {
          $.ajax({
            type: "POST",
            url: 'controladores/api.php',
            data: {
              servicio: "getProductos",
              campo: '',
              valor: ''
            },
            success: function (respuesta) {
              respuesta = JSON.parse(respuesta);
              app.productos = respuesta;


            }
          });
        },
        getCategorias() {
          $.ajax({
            type: "POST",
            url: 'controladores/api.php',
            data: {
              servicio: "getCategorias",
            },
            success: function (respuesta) {
              respuesta = JSON.parse(respuesta);
              app.categorias = respuesta;
            }
          });
        }
      }
    });


  </script>

</body>

</html>