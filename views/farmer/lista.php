<?php require_once __DIR__ . '/../layout/header.php'; ?>
<!-- ✅ Cabecera común del sitio / Common site header -->

<div class="container mt-5">
    <h2 class="mb-4">Caficultores Registrados</h2>

    <!-- ✅ Botón para exportar los datos a CSV / Button to export data to CSV -->
    <a href="index.php?controller=farmer&action=exportar" class="btn mb-3" style="background-color: #4E7316; color: white;">
        <i class="bi bi-download"></i> Exportar CSV
    </a>

    <!-- ✅ Tabla con los registros de caficultores / Table with farmer records -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr class="text-center">
                <th style="background-color: #59463F; color: white;">Nombre</th>
                <th style="background-color: #59463F; color: white;">Ubicación</th>
                <th style="background-color: #59463F; color: white;">Email</th>
                <th style="background-color: #59463F; color: white;">Teléfono</th>
                <th style="background-color: #59463F; color: white;">Descripción</th>
                <th style="background-color: #59463F; color: white;">Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($farmers as $farmer): ?>
                <tr>
                    <td><?= htmlspecialchars($farmer['name']) ?></td>
                    <td>
                        <?= htmlspecialchars($farmer['location_type']) ?> -
                        <?= htmlspecialchars($farmer['sidewalk']) ?>
                    </td>
                    <td><?= htmlspecialchars($farmer['email'] ?? 'No disponible / Not available') ?></td>
                    <td><?= htmlspecialchars($farmer['phone']) ?></td>
                    <td><?= htmlspecialchars($farmer['description']) ?></td>
                    <td><?= date('d/m/Y', strtotime($farmer['created_at'])) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
<!-- ✅ Pie de página común del sitio / Common site footer -->