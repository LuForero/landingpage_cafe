<!DOCTYPE html>
<html lang="es"> <!-- Define el idioma del documento / Set the language of the document to Spanish -->

<head>
    <meta charset="UTF-8"> <!-- Codificación de caracteres / Character encoding -->
    <title>Recuperar Contraseña</title> <!-- Título de la página / Page title -->

    <!-- Importar Bootstrap desde CDN / Import Bootstrap from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Estilos para el cuerpo / Styles for body */
        body {
            background-image: url('img/img-fondo-formulario.jpg');
            /* Imagen de fondo / Background image */
            background-size: cover;
            /* Cubrir toda la pantalla / Cover full screen */
            background-position: center;
            /* Centrar la imagen / Center the image */
            background-repeat: no-repeat;
            /* No repetir / Do not repeat */
            min-height: 100vh;
            /* Altura mínima de la ventana / Full viewport height */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Contenedor del formulario / Form container */
        .forgot-container {
            background-color: rgba(255, 255, 255, 0.95);
            /* Fondo blanco semitransparente / White semi-transparent background */
            border-radius: 12px;
            /* Bordes redondeados / Rounded corners */
            padding: 40px;
            /* Espaciado interno / Inner padding */
            width: 100%;
            max-width: 500px;
            /* Ancho máximo / Maximum width */
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            /* Sombra sutil / Subtle shadow */
        }
    </style>
</head>

<body>

    <!-- Contenedor principal centrado / Main centered container -->
    <div class="forgot-container text-center">
        <h2 class="mb-3">¿Olvidaste tu contraseña?</h2> <!-- Título principal / Main title -->
        <p class="mb-4">Ingresa tu correo y te enviaremos un enlace para restablecerla.</p> <!-- Descripción / Description -->

        <!-- Formulario de envío de email / Email submission form -->
        <form action="index.php?controller=auth&action=sendResetEmail" method="POST">
            <div class="mb-3 text-start">
                <label for="email" class="form-label">Correo electrónico</label> <!-- Etiqueta del campo / Field label -->
                <input type="email" name="email" id="email" class="form-control" required placeholder="Email">
                <!-- Campo de entrada / Input field -->
            </div>

            <button type="submit" class="btn btn-primary w-100">Enviar enlace</button> <!-- Botón de envío / Submit button -->
        </form>

        <!-- Enlace para volver al inicio de sesión / Link back to login page -->
        <div class="mt-3">
            <a href="index.php?controller=auth&action=login" class="btn btn-link">Volver al inicio de sesión</a>
        </div>
    </div>

</body>

</html>