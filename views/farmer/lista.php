<?php require_once __DIR__ . '/../layout/header.php'; ?>
<div class="container mt-5">
    <h2 class="mb-4">Caficultores Registrados</h2>
    <a href="index.php?controller=farmer&action=exportar" class="btn btn-success mb-3">
        <i class="bi bi-download"></i> Exportar CSV
    </a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark text-center">
            <tr>
                <th>Nombre</th>
                <th>Ubicación</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Descripción</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($farmers as $farmer): ?>
                <tr>
                    <td><?= htmlspecialchars($farmer['name']) ?></td>
                    <td><?= htmlspecialchars($farmer['location_type']) ?> - <?= htmlspecialchars($farmer['sidewalk']) ?></td>
                    <td><?= htmlspecialchars($farmer['email']) ?></td>
                    <td><?= htmlspecialchars($farmer['phone']) ?></td>
                    <td><?= htmlspecialchars($farmer['description']) ?></td>
                    <td><?= date('d/m/Y', strtotime($farmer['created_at'])) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>