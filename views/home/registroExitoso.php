<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro Exitoso / Successful Registration</title>
    <!-- Estilos de Bootstrap / Bootstrap Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        /* Fondo con imagen / Background with image */
        body {
            position: relative;
            background-image: url('/Landingpage-cafe/public/img/img-fondo-formulario.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Capa semitransparente opcional para oscurecer fondo /
           Optional semi-transparent overlay to darken the background */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            z-index: 0;
            /* Detrás del contenido / Behind content */
        }

        /* Contenido principal centrado / Main centered content */
        .content {
            position: relative;
            z-index: 1;
        }
    </style>
</head>

<body>

    <!-- Contenedor principal del mensaje / Main container for the message -->
    <div class="container text-center content">
        <div class="card shadow p-5 mx-auto" style="max-width: 500px;">
            <!-- Título con icono de éxito / Title with success icon -->
            <h2 class="text-success mb-4">
                <i class="bi bi-check-circle-fill"></i> ¡Registro exitoso!
            </h2>

            <!-- Mensaje de agradecimiento / Thank you message -->
            <p class="lead">Gracias por registrarte. Te contactaremos pronto.<br>
            </p>

            <!-- Botón para volver al inicio / Button to return to homepage -->
            <a href="/Landingpage-cafe/public/" class="btn btn-primary mt-3">
                Volver al inicio
            </a>
        </div>
    </div>

</body>

</html>