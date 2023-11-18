// Evento que se dispara cuando todos los elementos del DOM han sido completamente cargados.

window.onload = function () {
  // Array que contiene objetos con la URL de las imágenes y texto asociado a cada imagen.
  const urlImages = [
    {
      url: "./assets/images/1.jpg",
      text: "El viaje de Chihiro – Clasificación: A",
      director: "Robert Luketic",
      productor: "Walter F. Parkes",
      actor1: "Robert Luketic",
      actor2: "Walter F. Parkes",
    },
    {
      url: "./assets/images/2.jpg",
      text: "Paw Patrol: La Película – Clasificación: A",
      director: "Craig Gillespie",
      productor: "Andrew Gunn",
      actor1: "Craig Gillespie",
      actor2: "Andrew Gunn",
    },
    {
      url: "./assets/images/3.jpg",
      text: "Imax – Clasificación: B",
      director: "Robert Luketic",
      productor: "Walter F. Parkes",
      actor1: "Robert Luketic",
      actor2: "Walter F. Parkes",
    },
    {
      url: "./assets/images/4.jpg",
      text: "Sobreviviendo mi XV – Clasificación: B",
      director: "Craig Gillespie",
      productor: "Andrew Gunn",
      actor1: "Craig Gillespie",
      actor2: "Andrew Gunn",
    },
    {
      url: "./assets/images/5.jpeg",
      text: "Cruella – Clasificación: B",
      director: "Craig Gillespie",
      productor: "Andrew Gunn",
      actor1: "Craig Gillespie",
      actor2: "Andrew Gunn",
    },
  ];
  // Obtiene el elemento del DOM donde se mostrarán las imágenes del carrusel.
  let carouselImages = document.querySelector(".carousel-images");

  // Itera sobre cada objeto en el array 'urlImages'.
  urlImages.forEach((image) => {
    // Agrega dinámicamente un nuevo elemento de imagen al carrusel para cada imagen en el array.
    // Utiliza 'innerHTML' para modificar el contenido HTML del elemento 'carouselImages'.
    carouselImages.innerHTML += `
        <div class="carousel-image" onmouseover="resizeImageOnHover(this)" onclick="showMovieInfo(this, {director: '${image.director}', productor: '${image.productor}', actor1: '${image.actor1}', actor2: '${image.actor2}'})"  >
            <img src="${image.url}" alt="${image.text}" />
            <div class="carousel-image-text">
                <p>${image.text}</p>
            </div>
            <div class="movieInfo">
            </div>
        </div>
        `;
  });

  // Variable para llevar un registro del índice de la imagen actualmente visible en el carrusel.
  let currentIndex = 0;
  // Obtiene todos los elementos hijos del carrusel (las imágenes).
  const images = document.querySelector(".carousel-images").children;
  // Almacena el número total de imágenes en el carrusel.
  const totalImages = images.length;

  // Configura un intervalo para cambiar las imágenes del carrusel cada 3 segundos.
  setInterval(function () {
    // Actualiza 'currentIndex' para mostrar la siguiente imagen.
    // El operador '%' asegura que el índice regrese a 0 después de alcanzar el último índice.
    currentIndex = (currentIndex + 1) % 3;
    // Cambia la posición del carrusel para mostrar la imagen actual.
    // La transformación 'translateX' se utiliza para mover horizontalmente el carrusel.
    document.querySelector(".carousel-images").style.transform = `translateX(-${
      (currentIndex * 500) / totalImages
    }%)`;
  }, 3000); // Intervalo de tiempo en milisegundos para cambiar las imágenes.
};

function resizeImageOnHover(imageElement) {
  imageElement.style.transform = "scale(2)"; // Duplica el tamaño de la imagen
  imageElement.style.transition = "transform 0.5s ease"; // Agrega una transición suave

  imageElement.onmouseleave = function () {
    imageElement.style.transform = "scale(1)"; // Restaura el tamaño original de la imagen
  };
}

// Función que muestra la información de la película cuando el usuario hace clic en la imagen.
function showMovieInfo(imageElement, movieData) {
  let infoContainer = imageElement.querySelector(".movieInfo"); // Obtiene el elemento del DOM donde se mostrará la información de la película

  // Agrega dinámicamente un nuevo elemento de imagen al carrusel para cada imagen en el array.
  infoContainer.innerHTML = `
        <p>Director: ${movieData.director}</p>
        <p>Productor: ${movieData.productor}</p>
        <p>Actor Principal: ${movieData.actor1}</p>
        <p>Actriz Principal: ${movieData.actor2}</p>
    `;
}
