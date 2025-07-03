<?php
// Incluye el encabezado general del layout
// Include the general layout header
require_once __DIR__ . '/../layout/header.php';
?>

<div class="container mt-5">
    <!-- Título de la página / Page title -->
    <h2 class="mb-4">Editar Usuario</h2>

    <!-- Formulario para editar usuario / User edit form -->
    <form action="index.php?controller=user&action=update" method="POST">

        <!-- Campo oculto con el ID del usuario / Hidden field with user ID -->
        <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id']) ?>">

        <!-- Campo: Nombre / Field: Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name"
                value="<?= htmlspecialchars($usuario['name']) ?>" required>
        </div>

        <!-- Campo: Correo electrónico / Field: Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email"
                value="<?= htmlspecialchars($usuario['email']) ?>" required>
        </div>

        <!-- Campo: Rol / Field: Role -->
        <div class="mb-3">
            <label for="role" class="form-label">Rol</label>
            <select class="form-select" name="role" id="role" required>
                <option value="admin" <?= $usuario['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="editor" <?= $usuario['role'] === 'editor' ? 'selected' : '' ?>>Editor</option>
            </select>
        </div>

        <!-- Botones de acción / Action buttons -->
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <a href="index.php?controller=user&action=index" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php
// Incluye el pie de página general del layout
// Include the general layout footer
require_once __DIR__ . '/../layout/footer.php';
?>