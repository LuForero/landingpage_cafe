<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('/Landingpage-cafe/public/img/img-fondo-formulario.jpg');
            /* Cambia esta ruta a tu imagen */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Capa oscura para darle opacidad al fondo */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            /* Ajusta aquí la opacidad */
            z-index: 0;
        }

        .card {
            position: relative;
            z-index: 1;
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-lg border-0" style="width: 100%; max-width: 400px;">
            <h2 class="mb-4 text-center">Iniciar Sesión</h2>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form action="index.php?controller=auth&action=loginPost" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa tu correo" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                </div>

                <!-- Botón Iniciar sesión -->
                <button type="submit" class="btn btn-primary w-100 mb-3">Iniciar sesión</button>

                <!-- Botón Volver al inicio -->
                <a href="/Landingpage-cafe/public/" class="btn w-100" style="background-color: #262526; color: white;">Volver al inicio</a>

                <div class="text-center mt-3">
                    <a href="index.php?controller=auth&action=forgotPassword" class="btn btn-link p-0">
                        ¿Olvidaste tu contraseña?
                    </a>
                </div>
            </form>
        </div>
    </div>