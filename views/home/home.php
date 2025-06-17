<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Café Montañero</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <!-- Aquí van botones que me redirigen a la sesión de la página, incluido logo -->
    <nav class="navbar navbar-expand-lg shadow-sm" style="background-color: #F2DAC4;">
        <div class="container">
            <a class="navbar-brand" href="index.php?action=home">
                <img src="../public/img/logo-cafe.png" alt="Logo Café" width="50" height="50" class="d-inline-block align-text-top">
                Café Montañero
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

                <!-- Aquí van botones de registro y de iniciar sesión dentro del nav -->
                <div class="d-flex ms-3">
                    <a href="index.php?action=registro" class="btn me-2" style="background-color: #4E7316; color: white;">Registro de Caficultores</a>
                    <a href="index.php?controller=auth&action=login" class="btn" style="background-color: #BF8E63; color: white;">Iniciar Sesión</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero imagen Banner, botones registro caficultores -->
    <section class="position-relative text-white text-center" style="background-image: url('../public/img/img.hero.caficultor.jpg'); background-size: cover; background-position: center; height: 500px;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.4);"></div>

        <div class="position-absolute top-50 start-0 translate-middle-y ps-5 text-start">
            <h1 class="display-4 fw-bold">Café Montañero</h1>
            <p class="lead d-flex align-items-center gap-2">Conectamos caficultores con amantes del buen café</p>

            <!-- <a href="index.php?action=registro" class="btn mt-3 shadow" style="background-color: #59463F; color: white;">
                <i class="bi bi-cup-hot fs-5 me-2 text-warning"></i> Conviértete en caficultor aliado
            </a>--> <!-- Botón opcional en el hero que me lleva al registro de caficultores -->
        </div>
    </section>

    <!-- ¿Quiénes somos? -->
    <section id="quienes-somos" style="background-color: #262526; color: white; padding: 80px 0;">
        <div class="container">
            <div class="row align-items-center">
                <!-- Texto -->
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="display-6 fw-bold mb-4">¿Quiénes somos?</h2>
                    <p class="lead">
                        Somos un emprendimiento comprometido con la conexión directa entre caficultores y amantes del café auténtico.
                        Iniciamos esta travesía en Marquetalia, Caldas, una tierra reconocida por su café de altura y excelencia.
                    </p>
                    <p>
                        Nuestro café es seleccionado cuidadosamente por caficultores especialistas, cumpliendo con los más altos estándares de calidad.
                        Trabajamos hombro a hombro con comunidades rurales para ofrecer un proceso transparente, sostenible y con trazabilidad completa
                        desde la finca hasta la taza.
                    </p>
                    <a href="index.php?action=registro" class="btn btn-outline-success mt-4" style="background-color: #4E7316; color: white;">
                        Únete como caficultor aliado
                    </a>
                </div>

                <!-- Acá va la imagen del café en png -->
                <div class="col-lg-6 text-center">
                    <img src="../public/img/planta-cafe.png" alt="Equipo de caficultores" class="img-fluid rounded shadow">
                </div>
            </div>

            <!-- Cards del equipo -->
            <div class="row mt-5 text-center">
                <h3 class="text-white mb-4">Conoce al equipo detrás del proyecto</h3>

                <div class="col-md-4">
                    <div class="card bg-dark text-white border-0 shadow">
                        <img src="../public/img/img-caficultor3.jpg" class="card-img-top" alt="Nombre Persona 1">
                        <div class="card-body">
                            <h5 class="card-title">Luisa Martínez</h5>
                            <p class="card-text">Fundadora y gestora del proyecto. Apasionada por el desarrollo rural y la calidad del café colombiano.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mt-4 mt-md-0">
                    <div class="card bg-dark text-white border-0 shadow">
                        <img src="../public/img/img-baristaexperto.jpg" class="card-img-top" alt="Nombre Persona 2">
                        <div class="card-body">
                            <h5 class="card-title">Carlos Ramírez</h5>
                            <p class="card-text">Especialista en procesos de producción de café y relaciones con caficultores en Caldas.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mt-4 mt-md-0">
                    <div class="card bg-dark text-white border-0 shadow">
                        <img src="../public/img/img-comunicaciones.jpg" class="card-img-top" alt="Nombre Persona 3">
                        <div class="card-body">
                            <h5 class="card-title">María Fernanda López</h5>
                            <p class="card-text">Encargada de comunicaciones, difusión del proyecto y contacto con clientes.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Caficultores aliados -->
    <section id="caficultores" style="background-color: #F2DAC4; padding: 80px 0;">
        <div class="container">
            <!-- Título llamativo -->
            <div class="text-center mb-5">
                <h2 class="display-6 fw-bold" style="color: #4E7316;">Caficultores que cultivan historias en cada grano</h2>
                <p class="lead text-muted">Nuestros aliados en el campo son el corazón de este proyecto.</p>
            </div>

            <div class="row align-items-center mb-5">
                <!-- Imagen izquierda con tamaño reducido -->
                <div class="col-lg-6 mb-4 mb-lg-0 text-center">
                    <img src="../public/img/img-caficultor1.jpg" alt="Caficultor trabajando" class="img-fluid rounded shadow" style="max-width: 80%; height: auto;">
                </div>

                <!-- Texto derecha -->
                <div class="col-lg-6">
                    <h4 class="fw-bold" style="color: #4E7316;">Desde la raíz: compromiso y tradición</h4>
                    <p>
                        En cada finca aliada crece mucho más que café: crecen sueños, familias, herencias y saberes transmitidos por generaciones.
                        Nos aliamos con caficultores que cultivan con conciencia, respeto por la tierra y pasión por entregar lo mejor de sí en cada cosecha.
                    </p>
                    <p>
                        Nos enorgullece iniciar desde Marquetalia, Caldas, una tierra donde el aroma del café es sinónimo de identidad y orgullo.
                        Nuestro modelo elimina intermediarios, asegurando mejores condiciones para quienes trabajan la tierra.
                    </p>
                </div>
            </div>

            <div class="row align-items-center flex-lg-row-reverse">
                <!-- Imagen derecha con tamaño reducido -->
                <div class="col-lg-6 mb-4 mb-lg-0 text-center">
                    <img src="../public/img/img-secadodelcafé.jpg" alt="Cosecha de café" class="img-fluid rounded shadow" style="max-width: 80%; height: auto;">
                </div>

                <!-- Texto izquierda con botón -->
                <div class="col-lg-6">
                    <h4 class="fw-bold" style="color: #4E7316;">¿Eres caficultor y quieres unirte?</h4>
                    <p>
                        Queremos conocerte y construir juntos un comercio más justo y humano.
                        Si cultivas café y estás comprometido con la calidad, sostenibilidad y el desarrollo local,
                        este es tu espacio.
                    </p>
                    <p>
                        Sé parte de una red de caficultores orgullosos de su trabajo, con visibilidad, respaldo y conexión directa con consumidores conscientes.
                    </p>
                    <a href="index.php?action=registro" class="btn btn-success mt-3">Quiero unirme como caficultor aliado</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Proceso del café -->
    <section id="proceso" style="background-color: #fff; padding: 80px 0;">
        <div class="container">
            <!-- Título -->
            <div class="text-center mb-5">
                <h2 class="display-6 fw-bold" style="color: #4E7316;">Del grano a tu taza</h2>
                <p class="lead text-muted">Cada paso cuenta. Nuestro proceso es transparente, artesanal y cuidadosamente seleccionado para ofrecerte un café excepcional.</p>
            </div>

            <!-- Pasos del proceso -->
            <div class="row text-center">
                <div class="col-md-3 mb-5">
                    <img src="../public/img/paso1.png" alt="Cultivo" style="width: 80px;" class="mb-3">
                    <h5 class="fw-bold">1. Cultivo</h5>
                    <p class="text-muted">Nuestros caficultores siembran con pasión en tierras fértiles como Marquetalia, Caldas.</p>
                </div>

                <div class="col-md-3 mb-5">
                    <img src="../public/img/paso2.png" alt="Cosecha" style="width: 80px;" class="mb-3">
                    <h5 class="fw-bold">2. Cosecha</h5>
                    <p class="text-muted">Se recolectan a mano los granos maduros, seleccionando solo los mejores.</p>
                </div>

                <div class="col-md-3 mb-5">
                    <img src="../public/img/paso3.png" alt="Beneficio y secado" style="width: 80px;" class="mb-3">
                    <h5 class="fw-bold">3. Beneficio y secado</h5>
                    <p class="text-muted">El grano es lavado, secado al sol y tratado de manera artesanal.</p>
                </div>

                <div class="col-md-3 mb-5">
                    <img src="../public/img/paso4.png" alt="Empaque y entrega" style="width: 80px;" class="mb-3">
                    <h5 class="fw-bold">4. Empaque & entrega</h5>
                    <p class="text-muted">El café se empaca fresco y llega directamente a tu hogar sin intermediarios.</p>
                </div>
            </div>

            <!-- Llamado a la acción -->
            <div class="text-center mt-5">
                <a href="index.php?action=products" class="btn btn-outline-success btn-lg">Descubre nuestros cafés</a>
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
<?php require_once __DIR__ . '/../layout/footer.php'; ?>

</html>