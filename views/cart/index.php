<?php require_once __DIR__ . '/../layout/header_dashboard.php'; ?>

<div class="container my-5">
    <h2 class="mb-4 text-center">Productos Facturados</h2>

    <?php if (!empty($_SESSION['cart'])): ?>
        <table class="table table-hover table-bordered">
            <thead class="table-dark text-center">
                <tr>
                    <th>Producto</th>
                    <th>Precio Unitario</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; ?>
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <?php $subtotal = $item['price'] * $item['quantity']; ?>
                    <?php $total += $subtotal; ?>
                    <tr class="text-center align-middle">
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td>$<?= number_format($item['price'], 0, ',', '.') ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td>$<?= number_format($subtotal, 0, ',', '.') ?></td>
                        <td>
                            <a href="index.php?controller=cart&action=remove&id=<?= $item['id'] ?>" class="btn btn-outline-danger btn-sm">
                                Eliminar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="text-end mt-4">
            <h4>Total a Pagar: <span class="text-success fw-bold">$<?= number_format($total, 0, ',', '.') ?></span></h4>
            <a href="index.php?controller=cart&action=checkout" class="btn btn-success btn-lg mt-3">
                Confirmar Compra
            </a>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center">
            No hay productos en el carrito.
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../layout/footer_dashboard.php'; ?>