<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Reproducir Película - PelisNow</title>
  <link rel="stylesheet" href="../styles.css" />
  <script>
    function cargarVideo() {
      const parametrosUrl = new URLSearchParams(window.location.search);
      const idPelicula = parametrosUrl.get("id");

      const urlVideo =
        "http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4";

      document.getElementById("video-player").setAttribute("src", urlVideo);
    }
  </script>
</head>

<body onload="cargarVideo();">
  <div class="video-container">
    <video id="video-player" controls width="100%" autoplay>
      <source id="video-source" type="video/mp4" />
      Tu navegador no soporta el elemento de video HTML5.
    </video>
  </div>
  <footer class="site-footer">
    <div class="footer-bottom">
      <p>AOA – PW1 – Noviembre/2023</p>
    </div>
  </footer>
</body>

</html>