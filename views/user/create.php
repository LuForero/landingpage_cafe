<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Registro de Usuarios</h2>

    <form action="index.php?controller=user&action=registrar" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Roles</label>
            <select class="form-select" name="role" id="role" required>
                <option value="">Selecciona un rol</option>
                <option value="admin">Admin</option>
                <option value="editor">Editor</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Registrar Usuario</button>
    </form>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>