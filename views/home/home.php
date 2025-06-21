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
            <a class="navbar-brand" href="http://localhost:8888/Landingpage-cafe/public/">
                <img src="../public/img/logo-cafemontañero.png" alt="Logo Café" width="180" height="70" class="d-inline-block align-text-top">
                <!--Café Montañero-->
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

    <!-- Hero con Carousel automático y puntos indicadores -->
    <section id="heroCarousel">
        <div id="carouselCafe" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

            <!-- Indicadores -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselCafe" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselCafe" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselCafe" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselCafe" data-bs-slide-to="3" aria-label="Slide 4"></button>
            </div>

            <!-- Slides -->
            <div class="carousel-inner">

                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <div class="position-relative text-white text-center" style="background-image: url('../public/img/img.hero.caficultor1.jpg'); background-size: cover; background-position: center; height: 500px;">
                        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.4);"></div>
                        <div class="position-absolute top-50 start-0 translate-middle-y ps-5 text-start">
                            <h1 class="display-4 fw-bold">Café Montañero</h1>
                            <p class="lead">Conectamos caficultores con amantes del buen café</p>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="position-relative text-white text-center" style="background-image: url('../public/img/img-hero1.jpg'); background-size: cover; background-position: center; height: 500px;">
                        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.4);"></div>
                        <div class="position-absolute top-50 start-0 translate-middle-y ps-5 text-start">
                            <h1 class="display-4 fw-bold">Pasión en cada grano</h1>
                            <p class="lead">Molienda artesanal que despierta aromas, conserva la esencia y honra la tradición cafetera.</p>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item">
                    <div class="position-relative text-white text-center" style="background-image: url('../public/img/img-hero2.jpg'); background-size: cover; background-position: center; height: 500px;">
                        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.4);"></div>
                        <div class="position-absolute top-50 start-0 translate-middle-y ps-5 text-start">
                            <h1 class="display-4 fw-bold">Apoyamos al campo colombiano</h1>
                            <p class="lead">Un café justo, sostenible y de calidad.</p>
                        </div>
                    </div>
                </div>

                <!-- Slide 4 -->
                <div class="carousel-item">
                    <div class="position-relative text-white text-center" style="background-image: url('../public/img/img-hero3.jpg'); background-size: cover; background-position: center; height: 500px;">
                        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.4);"></div>
                        <div class="position-absolute top-50 start-0 translate-middle-y ps-5 text-start">
                            <h1 class="display-4 fw-bold">Aroma que inspira</h1>
                            <p class="lead">El café recién molido conserva la magia del campo colombiano en cada taza.</p>
                        </div>
                    </div>
                </div>

            </div>
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

            <!-- Cards con fotos de las personas que conforman el equipo -->
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
                    <img src="../public/img/img-secadodelcafé.jpg" alt="Caficultor trabajando" class="img-fluid rounded shadow" style="max-width: 80%; height: auto;">
                </div>

                <!-- Texto derecha -->
                <div class="col-lg-6">
                    <h4 class="fw-bold" style="color: #4E7316;">Desde la raíz: Compromiso y Tradición</h4>
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
                    <img src="../public/img/img-caficultor1.jpg" alt="Cosecha de café" class="img-fluid rounded shadow" style="max-width: 80%; height: auto;">
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
                    <a href="index.php?action=registro" class="btn btn-outline-success mt-4" style="background-color: #4E7316; color: white;">Quiero unirme como caficultor aliado</a>
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
                <p class="lead text-muted">Cada paso cuenta, nuestro proceso es transparente, artesanal y cuidadosamente seleccionado para ofrecerte un café excepcional.</p>
            </div>

            <!-- Pasos del proceso -->
            <div class="row text-center">
                <div class="col-md-3 mb-5">
                    <img src="../public/img/img-1.cultivo.png" alt="Cultivo" style="width: 80px;" class="mb-3">
                    <h5 class="fw-bold">1. Cultivo</h5>
                    <p class="text-muted">Nuestros caficultores siembran con pasión en tierras fértiles como Marquetalia, Caldas.</p>
                </div>

                <div class="col-md-3 mb-5">
                    <img src="../public/img/img-2.cosecha.png" alt="Cosecha" style="width: 80px;" class="mb-3">
                    <h5 class="fw-bold">2. Cosecha</h5>
                    <p class="text-muted">Se recolectan a mano los granos maduros, seleccionando solo los mejores.</p>
                </div>

                <div class="col-md-3 mb-5">
                    <img src="../public/img/img-3.secado.png" alt="Beneficio y secado" style="width: 80px;" class="mb-3">
                    <h5 class="fw-bold">3. Beneficio y secado</h5>
                    <p class="text-muted">El grano es lavado, secado al sol y tratado de manera artesanal.</p>
                </div>

                <div class="col-md-3 mb-5">
                    <img src="../public/img/img-4.empaque.png" alt="Empaque y entrega" style="width: 80px;" class="mb-3">
                    <h5 class="fw-bold">4. Empaque & entrega</h5>
                    <p class="text-muted">El café se empaca fresco y llega directamente a tu hogar sin intermediarios.</p>
                </div>
            </div>

            <!-- Llamado a la acción -->
            <div class="text-center mt-5">
                <a href="index.php?action=products" class="btn btn-outline-success btn-lg" style="background-color: #4E7316; color: white;">Descubre nuestro café</a>
            </div>
        </div>
    </section>

    <!-- Proceso de la siembra del café con una url de youtube incluida -->
    <section id="proceso" class="container text-center my-5">
        <h2 class="mb-4">Conoce nuestro proceso</h2>
        <div class="ratio ratio-16x9">
            <iframe
                src="https://www.youtube.com/embed/6QgJk1qFIps"
                title="Video del proceso del café"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
        </div>
    </section>

    <!-- Sección de Venta -->
    <section id="venta" class="py-5" style="background-color: #262526;">
        <div class="container text-center">
            <h2 class="display-5 fw-bold mb-4" style="color:rgb(255, 255, 255);">Descubre el Sabor del Café Montañero</h2>
            <p class="lead mb-5" style="color:rgb(255, 255, 255);">Compra café directamente de nuestros caficultores. Variedades 100% colombianas, seleccionadas y tostadas artesanalmente.</p>

            <div class="row row-cols-1 row-cols-md-3 g-4">
                <!-- Producto 1 -->
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="../public/img/img-caféviva.jpg" class="card-img-top" alt="Café Clásico" style="height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Café Montaña Viva</h5>
                            <p class="card-text">Presentación: 250g | Tostión media<br>Notas: Chocolate, nuez y caña de azúcar.</p>
                            <p class="fw-bold text-success">$20.000 COP</p>
                            <a href="#" class="btn btn-outline-success">Comprar ahora</a>
                        </div>
                    </div>
                </div>

                <!-- Producto 2 -->
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="../public/img/img-reserva-marquetalia.jpg" class="card-img-top" alt="Café Especialidad" style="height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Reserva Marquetalia</h5>
                            <p class="card-text">Presentación: 500g | Tostión alta<br>Origen: Marquetalia, Caldas.<br>Sabor intenso y aroma floral.</p>
                            <p class="fw-bold text-success">$35.000 COP</p>
                            <a href="#" class="btn btn-outline-success">Agregar al carrito</a>
                        </div>
                    </div>
                </div>

                <!-- Producto 3 -->
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="../public/img/img-aromamontañero.jpg" class="card-img-top" alt="Café Molido" style="height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Aroma Montañero</h5>
                            <p class="card-text">Presentación: 1kg | Molido<br>Café de especialidad para preparar en prensa o cafetera tradicional.</p>
                            <p class="fw-bold text-success">$60.000 COP</p>
                            <a href="#" class="btn btn-outline-success">Ver detalles</a>
                        </div>
                    </div>
                </div>

                <!-- Producto 4 -->
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="../public/img/img-granosupremo.jpg" class="card-img-top" alt="Café en grano" style="height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Café Grano Supremo</h5>
                            <p class="card-text">Presentación: 500g | En grano<br>Para moler al gusto. Ideal para métodos filtrados o espresso.</p>
                            <p class="fw-bold text-success">$38.000 COP</p>
                            <a href="#" class="btn btn-outline-success">Comprar</a>
                        </div>
                    </div>
                </div>

                <!-- Producto 5 -->
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="../public/img/img-cosechaoro.jpg" class="card-img-top" alt="Café Edición Limitada" style="height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Café Cosecha de Oro</h5>
                            <p class="card-text">Presentación: 250g | Tostión clara<br>Edición limitada de micro lote con sabores exóticos.</p>
                            <p class="fw-bold text-success">$28.000 COP</p>
                            <a href="#" class="btn btn-outline-success">Ver más</a>
                        </div>
                    </div>
                </div>
                <!-- Producto 6 -->
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="../public/img/img-gonzalez.jpg" class="card-img-top" alt="Café Edición Limitada" style="height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Finca González</h5>
                            <p class="card-text">Presentación: 250g | Molido o en grano<br>Café de finca única, sabores exóticos.</p>
                            <p class="fw-bold text-success">$28.000 COP</p>
                            <a href="#" class="btn btn-outline-success">Ver más</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Llamado a la acción en tres columnas -->
    <section id="caficultores" class="py-5" style="background-color: #F2DAC4; color: #000;">
        <div class="container">
            <div class="row align-items-center text-center text-md-start">

                <!-- Columna izquierda -->
                <div class="col-md-4 mb-4 mb-md-0">
                    <h2>¿Eres caficultor?</h2>
                    <p>Únete a nuestra red de productores.</p>
                    <a href="index.php?action=registro" class="btn" style="background-color: #4E7316; color: white;">Regístrate</a>
                </div>

                <!-- Columna del centro -->

                <div class="col-md-4 mb-4 mb-md-0">
                    <h2 class="display-6 fw-bold">¿Quieres saber más?</h2>
                    <p class="lead">Contáctanos y únete a la comunidad cafetera que impulsa el campo colombiano.</p>
                </div>

                <!-- Columna derecha con imagen -->
                <div class="col-md-4 text-center">
                    <img src="../public/img/img-cafe-taza.png" alt="Caficultor" class="img-fluid rounded" style="max-height: 200px;">
                </div>

            </div>
        </div>
    </section>


    <!-- Sección de Contacto Simple -->
    <section id="contacto" class="py-5 text-center" style="background-color: #262526; color: white;">
        <div class="container">
            <p><i class="bi bi-envelope-fill me-2 text-success"></i> contacto@cafemontanero.com</p>
            <p><i class="bi bi-telephone-fill me-2 text-success"></i> +57 310 123 4567</p>
            <p><i class="bi bi-geo-alt-fill me-2 text-success"></i> Marquetalia, Caldas - Colombia</p>

            <div class="mt-4">
                <h5 class="mb-3">Síguenos</h5>
                <a href="#" class="text-white me-3"><i class="bi bi-facebook fs-4"></i></a>
                <a href="#" class="text-white me-3"><i class="bi bi-instagram fs-4"></i></a>
                <a href="#" class="text-white"><i class="bi bi-whatsapp fs-4"></i></a>
            </div>
        </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<?php require_once __DIR__ . '/../layout/footer.php'; ?>

</html>