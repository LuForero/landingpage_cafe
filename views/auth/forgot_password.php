<?php require_once __DIR__ . '/../home/home.php'; ?>

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow-lg border-0" style="width: 100%; max-width: 400px;">
        <h4 class="mb-4 text-center">Restablecer contraseña</h4>

        <form action="index.php?controller=auth&action=sendResetEmail" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Introduce tu correo electrónico:</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control"
                    placeholder="ejemplo@correo.com"
                    required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Enviar enlace de recuperación</button>
        </form>

        <?php if (!empty($_GET['sent']) && $_GET['sent'] == 'true'): ?>
            <p class="mt-3 text-success text-center">
                Si el correo existe, se ha enviado un enlace de recuperación.
            </p>
        <?php elseif (!empty($_GET['sent']) && $_GET['sent'] == 'false'): ?>
            <p class="mt-3 text-danger text-center">
                No se pudo enviar el enlace. Verifique el correo.
            </p>
        <?php endif; ?>
    </div>
</div>