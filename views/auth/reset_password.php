<?php require_once __DIR__ . '/../home/home.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Restablecer Contraseña</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="d-flex flex-column min-vh-100 bg-light">

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-lg border-0" style="width: 100%; max-width: 400px;">

            <?php if (empty($_GET['token'])): ?>
                <div class="alert alert-danger text-center">
                    <p>Token no válido o expirado.</p>
                </div>
            <?php else: ?>
                <h2 class="mb-4 text-center">Restablecer Contraseña</h2>

                <form action="index.php?controller=auth&action=resetPassword" method="POST">
                    <input type="hidden" name="token" value="<?= htmlspecialchars($_GET['token']) ?>">

                    <div class="mb-3">
                        <label for="new_password" class="form-label">Nueva contraseña</label>
                        <input type="password" id="new_password" name="new_password" class="form-control" required minlength="6">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Actualizar contraseña</button>
                </form>
            <?php endif; ?>

        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <div class="container">
            <p class="mb-0">© 2025 Café de Origen. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>

</html>