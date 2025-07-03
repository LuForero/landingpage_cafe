<?php
// Incluye el encabezado general del layout
// Include the general layout header
require_once __DIR__ . '/../layout/header.php';
?>

<div class="container mt-5">
    <!-- Título principal / Main title -->
    <h2 class="mb-4">Usuarios Registrados</h2>

    <!-- Botón para agregar nuevo usuario / Button to add new user -->
    <a href="index.php?controller=user&action=create" class="btn btn-success mb-3" style="background-color: #4E7316; color: white;">
        <i class="bi bi-plus-circle"></i> Agregar Nuevo Usuario
    </a>

    <!-- Tabla de usuarios / Users table -->
    <table class="table table-bordered table-hover">
        <thead>
            <tr class="text-center">
                <th style="background-color: #59463F; color: white;">Nombre</th>
                <th style="background-color: #59463F; color: white;">Correo electrónico</th>
                <th style="background-color: #59463F; color: white;">Rol</th>
                <th style="background-color: #59463F; color: white;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= htmlspecialchars($usuario['name']) ?></td>
                    <td><?= htmlspecialchars($usuario['email']) ?></td>
                    <td><?= htmlspecialchars($usuario['role']) ?></td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">

                            <!-- Botón Editar / Edit button -->
                            <a href="index.php?controller=user&action=edit&id=<?= $usuario['id'] ?>" class="btn btn-sm" style="background-color: #4E7316; color: white;">Editar</a>
                            </a>

                            <!-- Botón Eliminar / Delete button -->
                            <a href="index.php?controller=user&action=delete&id=<?= $usuario['id'] ?>"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('¿Estás seguro?')">
                                <i class=""></i> Eliminar
                            </a>
                        </div>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
// Incluye el pie de página general del layout
// Include the general layout footer
require_once __DIR__ . '/../layout/footer.php';
?>