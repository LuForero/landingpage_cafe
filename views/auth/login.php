<head>
    <meta charset="UTF-8"> <!-- Character encoding / Codificación de caracteres -->
    <title>Iniciar Sesión</title> <!-- Page title / Título de la página -->

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        /* Estilo general del cuerpo / General body styling */
        body {
            background-image: url('/Landingpage-cafe/public/img/img-fondo-formulario.jpg');
            /* Background image / Imagen de fondo */
            background-size: cover;
            /* Fill the screen / Llenar la pantalla */
            background-position: center;
            /* Centered image / Imagen centrada */
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Capa oscura sobre la imagen / Dark overlay layer */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            /* Opacidad / Opacity */
            z-index: 0;
        }

        /* Tarjeta de inicio de sesión / Login card */
        .card {
            position: relative;
            z-index: 1;
        }
    </style>
</head>

<body>

    <!-- Contenedor principal centrado / Main centered container -->
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-lg border-0" style="width: 100%; max-width: 400px;">

            <h2 class="mb-4 text-center">Iniciar Sesión</h2> <!-- Form title / Título del formulario -->

            <!-- Mensaje de error si existe / Error message if exists -->
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <!-- Formulario de inicio de sesión / Login form -->
            <form action="index.php?controller=auth&action=loginPost" method="POST">

                <!-- Campo de correo / Email field -->
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label> <!-- Email label -->
                    <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa tu correo" required>
                </div>

                <!-- Campo de contraseña / Password field -->
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label> <!-- Password label -->
                    <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                </div>

                <!-- Botón para iniciar sesión / Submit button -->
                <button type="submit" class="btn btn-primary w-100 mb-3">Iniciar sesión</button>

                <!-- Botón para volver al home / Return to homepage button -->
                <a href="/Landingpage-cafe/public/" class="btn w-100" style="background-color: #262526; color: white;">Volver al inicio</a>

                <!-- Enlace para recuperación de contraseña / Password recovery link -->
                <div class="text-center mt-3">
                    <a href="index.php?controller=auth&action=forgotPassword" class="btn btn-link p-0">
                        ¿Olvidaste tu contraseña?
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>