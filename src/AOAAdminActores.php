<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Actores - PelisNow Admin</title>
  <link rel="stylesheet" href="styles.css" />
</head>

<body>
  <header>
    <nav class="navbar">
      <div class="navbar-brand">PelisNow</div>
      <div class="navbar-nav">
        <a href="AOAAdminInicio.php" class="nav-item">Inicio</a>
        <a href="AOAAdminPeliculas.php" class="nav-item">Películas</a>
        <a href="AOAAdminCategorias.php" class="nav-item">Categorías</a>
        <a href="AOAAdminDirectores.php" class="nav-item">Directores</a>
        <a href="AOAAdminActores.php" class="nav-item">Actores</a>
        <a href="AOALogin.php" class="nav-item">Logout</a>
      </div>
    </nav>
  </header>
  <div class="movies-container">
    <h1>Listado de actores</h1>
    <div class="add-button-container">
      <button onclick="location.href='/admin/AOARegistroActor.php'" class="add-movie-btn">
        Registrar Actor
      </button>
    </div>
    <table class="movies-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Nacionalidad</th>
          <th>Fecha nacimiento</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Rumi Hiiragi</td>
          <td>rumi.hiiragi@example.com</td>
          <td>Japonesa</td>
          <td>1987-08-01</td>
          <td>
            <button class="btn-play">Editar</button>
            <button class="btn-play">Eliminar</button>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td>Memo Villegas</td>
          <td>memo.villegas@example.com</td>
          <td>Mexicano</td>
          <td>1987-05-26</td>
          <td>
            <button class="btn-play">Editar</button>
            <button class="btn-play">Eliminar</button>
          </td>
        </tr>
        <tr>
          <td>3</td>
          <td>Brie Larson</td>
          <td>brie.larson@example.com</td>
          <td>Estado Unidense</td>
          <td>1989-10-01</td>
          <td>
            <button class="btn-play">Editar</button>
            <button class="btn-play">Eliminar</button>
          </td>
        </tr>
        <tr>
          <td>4</td>
          <td>Kim Kardashian</td>
          <td>kim.kardashian@example.com</td>
          <td>Estado Unidense</td>
          <td>1980-10-21</td>
          <td>
            <button class="btn-play">Editar</button>
            <button class="btn-play">Eliminar</button>
          </td>
        </tr>
        <tr>
          <td>5</td>
          <td>Jason Marsden</td>
          <td>jason.marsden@example.com</td>
          <td>Japonesa</td>
          <td>1988-03-23</td>
          <td>
            <button class="btn-play">Editar</button>
            <button class="btn-play">Eliminar</button>
          </td>
        </tr>
        <tr>
          <td>6</td>
          <td>Verónica Bravo</td>
          <td>vero.bravo@example.com</td>
          <td>Mexicana</td>
          <td>1980-10-21</td>
          <td>
            <button class="btn-play">Editar</button>
            <button class="btn-play">Eliminar</button>
          </td>
        </tr>
        <tr>
          <td>7</td>
          <td>Isman Vellani</td>
          <td>isman.vellani@example.com</td>
          <td>Estado Unidense</td>
          <td>2002-09-03</td>
          <td>
            <button class="btn-play">Editar</button>
            <button class="btn-play">Eliminar</button>
          </td>
        </tr>
        <tr>
          <td>8</td>
          <td>Ron Pardo</td>
          <td>ron.pardo@example.com</td>
          <td>Canadiense</td>
          <td>1967-05-15</td>
          <td>
            <button class="btn-play">Editar</button>
            <button class="btn-play">Eliminar</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <footer class="site-footer">
    <div class="footer-bottom">
      <p>AOA – PW1 – Noviembre/2023</p>
    </div>
  </footer>
</body>

</html>