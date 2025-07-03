<!DOCTYPE html>
<html lang="es"> <!-- Lenguaje del documento / Document language -->

<head>
    <meta charset="UTF-8"> <!-- Codificación de caracteres / Character encoding -->
    <title>Restablecer Contraseña con Código</title> <!-- Título de la pestaña / Page title -->

    <!-- Bootstrap CDN para estilos / Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Estilo general del fondo / General body styling */
        body {
            background-image: url('img/img-fondo-formulario.jpg');
            /* Imagen de fondo / Background image */
            background-size: cover;
            /* Cubrir todo / Cover full screen */
            background-position: center;
            /* Centrar / Center */
            background-repeat: no-repeat;
            min-height: 100vh;
            /* Altura total / Full viewport height */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Contenedor del formulario / Form container */
        .reset-container {
            background-color: rgba(255, 255, 255, 0.95);
            /* Fondo blanco translúcido / Semi-transparent background */
            border-radius: 12px;
            /* Bordes redondeados / Rounded corners */
            padding: 40px;
            width: 100%;
            max-width: 500px;
            /* Ancho máximo / Max width */
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            /* Sombra / Shadow */
        }
    </style>
</head>

<body>

    <div class="reset-container text-center"> <!-- Contenedor principal / Main container -->
        <h2 class="mb-3">Restablecer Contraseña</h2> <!-- Título del formulario / Form title -->

        <!-- Mensaje de éxito / Success message -->
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['success_message'];
                unset($_SESSION['success_message']); ?>
            </div>
        <?php endif; ?>

        <!-- Mensaje de error / Error message -->
        <?php if (isset($_SESSION['reset_error'])): ?>
            <div class="alert alert-danger">
                <?= $_SESSION['reset_error'];
                unset($_SESSION['reset_error']); ?>
            </div>
        <?php endif; ?>

        <!-- Formulario para restablecer la contraseña / Password reset form -->
        <form action="index.php?controller=auth&action=resetPassword" method="POST">

            <!-- Campo de correo electrónico / Email field -->
            <div class="mb-3 text-start">
                <label for="email" class="form-label">Correo electrónico</label> <!-- Label -->
                <input type="email" name="email" id="email" class="form-control" required
                    value="<?= htmlspecialchars($_SESSION['reset_email'] ?? '') ?>">
            </div>

            <!-- Campo del código (token) / Token field -->
            <div class="mb-3 text-start">
                <label for="token" class="form-label">Código de recuperación</label>
                <input type="text" name="token" id="token" class="form-control" required>
            </div>

            <!-- Nueva contraseña / New password -->
            <div class="mb-3 text-start">
                <label for="password" class="form-label">Nueva contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <!-- Confirmar contraseña / Confirm password -->
            <div class="mb-3 text-start">
                <label for="confirm_password" class="form-label">Confirmar contraseña</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
            </div>

            <!-- Botón para enviar / Submit button -->
            <button type="submit" class="btn btn-primary w-100">Restablecer Contraseña</button>
        </form>

        <!-- Enlace para volver al login / Link to go back -->
        <div class="mt-3">
            <a href="index.php?controller=auth&action=login" class="btn btn-link">Volver al inicio de sesión</a>
        </div>
    </div>

</body>

</html>