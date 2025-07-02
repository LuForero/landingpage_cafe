<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Recuperar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('img/img-fondo-formulario.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .forgot-container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            padding: 40px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>

    <div class="forgot-container text-center">
        <h2 class="mb-3">¿Olvidaste tu contraseña?</h2>
        <p class="mb-4">Ingresa tu correo y te enviaremos un enlace para restablecerla.</p>

        <form action="index.php?controller=auth&action=sendResetEmail" method="POST">
            <div class="mb-3 text-start">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" name="email" id="email" class="form-control" required placeholder="Email">
            </div>

            <button type="submit" class="btn btn-primary w-100">Enviar enlace</button>
        </form>

        <div class="mt-3">
            <a href="index.php?controller=auth&action=login" class="btn btn-link">Volver al inicio de sesión</a>
        </div>
    </div>

</body>

</html>