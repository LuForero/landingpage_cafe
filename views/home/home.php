<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Café de Origen</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg shadow-sm" style="background-color: #F2DAC4;">
        <div class="container">
            <a class="navbar-brand" href="index.php?action=home">
                <img src="../public/img/logo-cafe.png" alt="Logo Café" width="50" height="50" class="d-inline-block align-text-top">
                Café de Origen
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCafe" aria-controls="navbarCafe" aria-expanded="false" aria-label="Menú">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCafe">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#quienes-somos">¿Quiénes somos?</a></li>
                    <li class="nav-item"><a class="nav-link" href="#caficultores">Caficultores</a></li>
                    <li class="nav-item"><a class="nav-link" href="#proceso">Proceso</a></li>
                    <li class="nav-item"><a class="nav-link" href="#venta">Venta</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contacto">Contacto</a></li>
                </ul>

                <!-- Aquí fuera del UL, pero dentro de navbar -->
                <div class="d-flex ms-3">
                    <a href="index.php?action=registro" class="btn btn-success me-2">Registro de Caficultores</a>
                    <a href="index.php?controller=auth&action=login" class="btn btn-primary">Iniciar Sesión</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero imagen Banner, botones registro caficultores -->
    <section class="position-relative text-white text-center" style="background-image: url('../public/img/img.hero.caficultor.jpg'); background-size: cover; background-position: center; height: 500px;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.4);"></div>

        <div class="position-absolute top-50 start-0 translate-middle-y ps-5 text-start">
            <h1 class="display-4 fw-bold">Café de Origen</h1>
            <p class="lead d-flex align-items-center gap-2">Conectamos caficultores con amantes del buen café</p>

            <!-- <a href="index.php?action=registro" class="btn mt-3 shadow" style="background-color: #59463F; color: white;">
                <i class="bi bi-cup-hot fs-5 me-2 text-warning"></i> Conviértete en caficultor aliado
            </a>--> <!-- Botón opcional en el hero que me lleva al registro de caficultores -->
        </div>
    </section>

    <!-- Quiénes somos -->
    <section id="quienes-somos" style="background-color: #262526; color: white; padding: 80px 0;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="display-6 fw-bold mb-4">¿Quiénes somos?</h2>
                    <p class="lead">Somos un emprendimiento que conecta directamente a los caficultores con los amantes del buen café.</p>
                    <p>Trabajamos con comunidades rurales para asegurar un proceso transparente, sostenible y de alta calidad desde la cosecha hasta tu taza.</p>
                    <a href="index.php?action=registro" class="btn btn-outline-light mt-4">Únete como caficultor aliado</a>
                </div>

                <div class="col-lg-6 text-center">
                    <img src="../public/img/planta-cafe.png" alt="Equipo de caficultores" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Proceso -->
    <section id="proceso" class="container text-center my-5">
        <h2>Conoce nuestro proceso</h2>
        <video controls width="100%">
            <source src="../public/video/proceso.mp4" type="video/mp4">
            Tu navegador no soporta video.
        </video>
    </section>

    <!-- Llamado a la acción -->
    <section id="caficultores" class="bg-dark text-white p-5 text-center">
        <h2>¿Eres caficultor?</h2>
        <p>Únete a nuestra red de productores.</p>
        <a href="index.php?action=registro" class="btn btn-success">Regístrate</a>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>