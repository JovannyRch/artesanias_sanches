<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Instituto México - Inicio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }


        p {
            max-width: 80vw;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-top: 20px;
        }

        .container {
            min-height: 100vh;
            padding-top: 100px;
            gap: 8px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>

    <nav class="navbar fixed-top navbar-expand-lg bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="index.php">Instituto Mexicano</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
                    </svg>

                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-white">

                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.php">Inicio</a>
                    </li>
                    <?php if (isset($_SESSION['tipoUsuario'])) : ?>
                        <?php if ($_SESSION['tipoUsuario'] == 'PDC') : ?>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="consultar_pagos.php">Consultar pagos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="registrar_pagos.php">Registrar pagos</a>
                            </li>
                        <?php elseif ($_SESSION['tipoUsuario'] == 'PF') : ?>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="consultar_pagos.php">Consultar pagos</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="logout.php">Salir</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="registrarse.php">Registrarse</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="iniciar_sesion.php">Iniciar sesión</a>
                        </li>
                    <?php endif; ?>

                </ul>

            </div>
        </div>
    </nav>

    <div class="container">

        <div style="max-width: 10%; margin: 0 auto">
            <img src="https://edutory.mx/wp-content/uploads/2023/02/instituto-mexico-secundaria-ims-logo-1006x1024.png" />
        </div>

        <div id="carouselExample" class="carousel slide w-75" style="margin: 0 auto;">
            <div class="carousel-inner" id="carousel-content">
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <br><br>

        <div class="modal  fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>

                </div>
            </div>
        </div>



        <br><br>


        <div class="row mt-4">
            <!-- Add costos -->
            <div class="col-4">
                <div class="card" style="width: 18rem;">

                    <div class="card-body">
                        <h5 class="card-title
                            ">Plan básico</h5>
                        <p class="card-text">$999.99 por mes</p>
                        <p class="card-text">Incluye: 1 materias</p>

                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card" style="width: 18rem;">

                    <div class="card-body">
                        <h5 class="card-title
                            ">Plan intermedio</h5>
                        <p class="card-text">$1,999.99 por mes</p>
                        <p class="card-text">Incluye: 2 materias</p>
                    </div>

                </div>

            </div>

            <div class="col-4">
                <div class="card" style="width: 18rem;">

                    <div class="card-body">
                        <h5 class="card-title
                            ">Plan avanzado</h5>
                        <p class="card-text">$2,999.99 por mes</p>
                        <p class="card-text">Incluye: 4 materias</p>

                    </div>

                </div>

            </div>

        </div>
        <div class="row" id="carreras-container">
        </div>

        <h2 class="text-left w-100 mt-4">
            Comentarios de nuestros alumnos
        </h2>
        <div class="row mt-2" id="comentarios">

        </div>

        <br> <br>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        const slides = [{
                title: 'Fachada principal',
                image: 'https://uvm.mx/storage/app/uploads/public/c13/ca6/25a/thumb__0_0_0_0_crop.jpg',
                description: 'Fachada principal del Instituto México'
            },
            {
                title: 'Salones de clase',
                image: 'https://uvm.mx/storage/app/uploads/public/5f1/05f/a71/5f105fa7112ed784717735.jpg',
                description: 'Salones de clase del Instituto México'
            },
            {
                title: 'Gimnasio',
                image: 'https://uvm.mx/storage/app/uploads/public/5f1/05f/1fd/5f105f1fdcf00427708903.jpg',
                description: 'Gimnasio del Instituto México'
            },

            {
                title: 'Biblioteca',
                image: 'https://uvm.mx/storage/app/uploads/public/636/c5e/44b/636c5e44bba8f741865771.jpg',
                description: 'Biblioteca del Instituto México'
            },
            {
                title: 'Laboratorios',
                image: 'https://uvm.mx/storage/app/uploads/public/5f1/05f/78c/5f105f78c2b8b125693720.jpg',
                description: 'Laboratorios del Instituto México'
            },
            {
                title: 'Canchas Deportivas',
                image: 'https://uvm.mx/storage/app/uploads/public/636/c5f/f98/636c5ff985699002667027.jpg',
                description: 'Canchas Deportivas del Instituto México'
            }
        ]

        window.onload = () => {
            const carouselContent = document.getElementById('carousel-content');
            slides.forEach((slide, index) => {
                const active = index === 0 ? 'active' : '';
                carouselContent.innerHTML += `
                <div class="carousel-item ${active}" data-bs-toggle="modal" data-bs-target="#exampleModal" title="${slide.title}" image=="${slide.image}">
                    <img src="${slide.image}" class="d-block w-100" alt="...">

                </div>
                `


            })
        }

        const carrerasMasSolicitadas = [{
                carrera: 'Licenciatura en Biología',
                imagen: 'https://uvm.mx/storage/app/uploads/public/931/600/dd6/thumb__0_0_0_0_crop.jpg'
            },
            {
                carrera: 'Bioquímica',
                imagen: 'https://uvm.mx/storage/app/uploads/public/f5c/5dd/031/thumb__0_0_0_0_crop.jpg'
            },
            {
                carrera: 'Biotecnología',
                imagen: 'https://uvm.mx/storage/app/uploads/public/ece/bf8/0b1/thumb__0_0_0_0_crop.jpg'
            },
        ]

        const comentarios = [{
                nombre: 'Juan Pérez',
                comentario: 'Excelente institución'
            },
            {
                nombre: 'María González',
                comentario: 'Muy buenos maestros'
            },
            {
                nombre: 'Pedro Sánchez',
                comentario: 'Instalaciones de primer nivel'
            }
        ]



        window.onload = () => {
            const carouselContent = document.getElementById('carousel-content');
            slides.forEach((slide, index) => {
                const active = index === 0 ? 'active' : '';
                carouselContent.innerHTML += `
                <div class="carousel-item ${active}" data-bs-toggle="modal" data-bs-target="#exampleModal" title="${slide.title}" image=="${slide.image}">
                    <img src="${slide.image}" class="d-block w-100" alt="...">

                </div>
                `


            })

            const carouselItems = document.querySelectorAll('.carousel-item');
            carouselItems.forEach((item, index) => {
                item.addEventListener('click', () => {
                    const modalTitle = document.querySelector('.modal-title');
                    modalTitle.textContent = slides[index].title;
                    const modalBody = document.querySelector('.modal-body');
                    console.log("modalBody", modalBody);
                    modalBody.innerHTML = `
                    <img src="${slides[index].image}" class="d-block w-
                    100" alt="...">`

                    modalBody.innerHTML += `<p>${slides[index].description}</p>`
                })
            })

            const carrerasContainer = document.getElementById('carreras-container');

            carrerasMasSolicitadas.forEach(carrera => {
                carrerasContainer.innerHTML += `
                <div class="col-4">
                    <div class="card" style="width: 18rem;">
                        <img src="${carrera.imagen}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title
                            ">${carrera.carrera}</h5>
                          
                        </div>
                    </div>
                </div>
                `
            })

            const comentariosContainer = document.getElementById('comentarios');
            comentarios.forEach(comentario => {
                comentariosContainer.innerHTML += `
                <div class="col-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title
                            ">${comentario.nombre}</h5>
                            <p class="card-text">${comentario.comentario}</p>
                        </div>
                    </div>
                </div>
                `
            })

        }
    </script>
</body>

</html>