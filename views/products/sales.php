<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container my-5">
    <h2 class="mb-4">Historial de Ventas</h2>

    <a href="index.php?controller=product&action=exportSalesCSV" class="btn btn-success mb-3">
        <i class="bi bi-download"></i> Exportar CSV
    </a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Orden</th>
                <th>Cliente</th>
                <th>Email</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Total Orden</th>
                <th>Estado</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sales as $venta): ?>
                <tr>
                    <td>#<?= $venta['order_id'] ?></td>
                    <td><?= isset($venta['customer_name']) ? htmlspecialchars($venta['customer_name']) : '' ?></td>
                    <td><?= isset($venta['email']) ? htmlspecialchars($venta['email']) : '' ?></td>
                    <td><?= htmlspecialchars($venta['product_name']) ?></td>
                    <td><?= $venta['quantity'] ?></td>
                    <td>$<?= number_format($venta['subtotal'], 0, ',', '.') ?></td>
                    <td>$<?= number_format($venta['total_amount'], 0, ',', '.') ?></td>
                    <td>
                        <?php
                        if (!empty($venta['status'])) {
                            if ($venta['status'] === 'pendiente') {
                                echo '<span class="badge bg-warning text-dark">Pendiente</span>';
                            } elseif ($venta['status'] === 'pagado') {
                                echo '<span class="badge bg-success">Pagado</span>';
                            } else {
                                echo '<span class="badge bg-danger">Cancelado</span>';
                            }
                        } else {
                            echo 'Sin estado';
                        }
                        ?>
                    </td>
                <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>