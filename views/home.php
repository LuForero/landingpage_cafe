<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Café de Origen</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <!-- Header con navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="img/logo-cafe.png" alt="Logo Café" width="50" height="50" class="d-inline-block align-text-top">
                Café de Origen
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCafe" aria-controls="navbarCafe" aria-expanded="false" aria-label="Menú">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCafe">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#quienes-somos">¿Quiénes somos?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#caficultores">Caficultores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#proceso">Proceso</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#venta">Venta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contacto">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Slider Bootstrap -->
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/slider1.jpg" class="d-block w-100" alt="Cultivo de café">
            </div>
            <div class="carousel-item">
                <img src="img/slider2.jpg" class="d-block w-100" alt="Proceso artesanal">
            </div>
            <div class="carousel-item">
                <img src="img/slider3.jpg" class="d-block w-100" alt="Producto final">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>

    <!-- Quiénes Somos -->
    <section id="quienes-somos" class="container text-center my-5">
        <h2>¿Quiénes somos?</h2>
        <p>Conectamos caficultores con amantes del café, garantizando calidad y comercio justo.</p>
    </section>

    <!-- Video del proceso -->
    <section id="proceso" class="container text-center my-5">
        <h2>Conoce nuestro proceso</h2>
        <video controls width="100%">
            <source src="video/proceso.mp4" type="video/mp4">
            Tu navegador no soporta video.
        </video>
    </section>

    <!-- Llamado a la acción - Caficultores -->
    <section id="caficultores" class="bg-dark text-white p-5 text-center">
        <h2>¿Eres caficultor?</h2>
        <p>Únete a nuestra red de productores.</p>
        <a href="index.php?action=registro" class="btn btn-success">Regístrate</a>
    </section>

    <!-- Scripts necesarios para Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>