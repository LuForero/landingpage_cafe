<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Usuarios Registrados</h2>

    <a href="index.php?controller=user&action=create" class="btn btn-success mb-3">
        <i class="bi bi-plus-circle"></i> Agregar Nuevo Usuario
    </a>


    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Correo electrónico</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= htmlspecialchars($usuario['name']) ?></td>
                    <td><?= htmlspecialchars($usuario['email']) ?></td>
                    <td><?= htmlspecialchars($usuario['role']) ?></td>
                    <td>
                        <a href="index.php?controller=user&action=edit&id=<?= $usuario['id'] ?>" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <a href="index.php?controller=user&action=delete&id=<?= $usuario['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">
                            <i class="bi bi-trash"></i> Eliminar
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>