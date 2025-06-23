<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container my-5">
    <h2 class="mb-4">Historial de Ventas</h2>

    <a href="index.php?controller=product&action=exportSalesCSV" class="btn btn-outline-success mb-3">
        <i class="bi bi-download"></i> Exportar CSV
    </a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark text-center">
            <tr>
                <th>Orden</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($sales)): ?>
                <?php foreach ($sales as $sale): ?>
                    <tr class="text-center">
                        <td><?= htmlspecialchars($sale['order_id']) ?></td>
                        <td><?= htmlspecialchars($sale['product_name']) ?></td>
                        <td><?= $sale['quantity'] ?></td>
                        <td>$<?= number_format($sale['subtotal'], 0, ',', '.') ?></td>
                        <td><?= htmlspecialchars($sale['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No hay ventas registradas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>