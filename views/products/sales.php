<?php
// Incluye el encabezado con la navegación y estilos comunes.
// Includes the header with navigation and shared styles.
require_once __DIR__ . '/../layout/header.php';
?>

<div class="container my-5">
    <!-- Título principal / Main title -->
    <h2 class="mb-4">Historial de Ventas</h2>

    <!-- Botón para exportar las ventas como archivo CSV / Button to export sales as CSV -->
    <a href="index.php?controller=product&action=exportSalesCSV" class="btn mb-3" style="background-color: #4E7316; color: white;">
        <i class="bi bi-download"></i> Exportar CSV
    </a>

    <!-- Tabla que muestra el historial de ventas / Table displaying the sales history -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr class="text-center">
                <th style="background-color: #59463F; color: white;">Orden</th>
                <th style="background-color: #59463F; color: white;">Cliente</th>
                <th style="background-color: #59463F; color: white;">Email</th>
                <th style="background-color: #59463F; color: white;">Producto</th>
                <th style="background-color: #59463F; color: white;">Cantidad</th>
                <th style="background-color: #59463F; color: white;">Subtotal</th>
                <th style="background-color: #59463F; color: white;">Total Orden</th>
                <th style="background-color: #59463F; color: white;">Estado</th>
                <th style="background-color: #59463F; color: white;">Fecha</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($sales as $venta): ?>
                <tr>
                    <!-- Número de orden / Order number -->
                    <td>#<?= $venta['order_id'] ?></td>

                    <!-- Datos del cliente / Customer info -->
                    <td><?= isset($venta['customer_name']) ? htmlspecialchars($venta['customer_name']) : '' ?></td>
                    <td><?= isset($venta['email']) ? htmlspecialchars($venta['email']) : '' ?></td>

                    <!-- Detalles del producto / Product details -->
                    <td><?= htmlspecialchars($venta['product_name']) ?></td>
                    <td><?= $venta['quantity'] ?></td>
                    <td>$<?= number_format($venta['subtotal'], 0, ',', '.') ?></td>
                    <td>$<?= number_format($venta['total_amount'], 0, ',', '.') ?></td>

                    <!-- Estado del pedido / Order status -->
                    <td>
                        <?php if ($venta['status'] === 'pagado'): ?>
                            <span class="badge bg-success">Pagado</span>
                        <?php elseif ($venta['status'] === 'cancelado'): ?>
                            <span class="badge bg-danger">Cancelado</span>
                        <?php else: ?>
                            <!-- Formulario para actualizar estado si es 'pendiente' /
                                 Form to update status if it's 'pending' -->
                            <form action="index.php?controller=updateOrderStatus" method="POST">
                                <input type="hidden" name="order_id" value="<?= $venta['order_id'] ?>">
                                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="pendiente" <?= $venta['status'] === 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                                    <option value="pagado">Pagado</option>
                                    <option value="cancelado">Cancelado</option>
                                </select>
                            </form>
                        <?php endif; ?>
                    </td>

                    <!-- Fecha del pedido / Order date -->
                    <td>
                        <?= !empty($venta['order_date']) && strtotime($venta['order_date']) !== false
                            ? date('Y-m-d H:i', strtotime($venta['order_date']))
                            : 'Sin fecha / No date' ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
// Incluye el pie de página con scripts compartidos.
// Includes the shared footer and scripts.
require_once __DIR__ . '/../layout/footer.php';
?>