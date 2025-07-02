<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Restablecer Contraseña con Código</title>
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

        .reset-container {
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

    <div class="reset-container text-center">
        <h2 class="mb-3">Restablecer Contraseña</h2>

        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success"><?= $_SESSION['success_message'];
                                                unset($_SESSION['success_message']); ?></div>
        <?php endif; ?>

        <?php if (isset($_SESSION['reset_error'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['reset_error'];
                                            unset($_SESSION['reset_error']); ?></div>
        <?php endif; ?>

        <form action="index.php?controller=auth&action=resetPassword" method="POST">
            <div class="mb-3 text-start">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" name="email" id="email" class="form-control" required value="<?= htmlspecialchars($_SESSION['reset_email'] ?? '') ?>">
            </div>

            <div class="mb-3 text-start">
                <label for="token" class="form-label">Código de recuperación</label>
                <input type="text" name="token" id="token" class="form-control" required>
            </div>

            <div class="mb-3 text-start">
                <label for="password" class="form-label">Nueva contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="mb-3 text-start">
                <label for="confirm_password" class="form-label">Confirmar contraseña</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Restablecer Contraseña</button>
        </form>

        <div class="mt-3">
            <a href="index.php?controller=auth&action=login" class="btn btn-link">Volver al inicio de sesión</a>
        </div>
    </div>

</body>

</html>