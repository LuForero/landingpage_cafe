<?php require_once __DIR__ . '/../layout/header_dashboard.php'; ?>

<style>
    body {
        background-image: url('img/img-fondo-formulario.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 100vh;
    }

    .checkout-container {
        background-color: rgba(255, 255, 255, 0.95);
        border-radius: 12px;
        padding: 40px;
        max-width: 900px;
        margin: 50px auto;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    }

    .logo-img {
        width: 120px;
    }
</style>

<div class="checkout-container text-center">
    <h2 class="mb-4">Finalizar Compra</h2>

    <?php if (!empty($_SESSION['cart'])): ?>
        <form action="index.php?controller=cart&action=simulatePayment" method="POST">
            <div class="row text-start">
                <!-- Resumen de compra -->
                <div class="col-md-6 border-end pe-4">
                    <h5 class="mb-3">Productos Facturados</h5>
                    <ul class="list-group mb-3">
                        <?php $total = 0; ?>
                        <?php foreach ($_SESSION['cart'] as $item): ?>
                            <?php $subtotal = $item['price'] * $item['quantity']; ?>
                            <?php $total += $subtotal; ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="w-50">
                                    <?= htmlspecialchars($item['name']) ?>
                                </div>
                                <input type="number" name="quantities[<?= $item['id'] ?>]" value="<?= $item['quantity'] ?>" min="1" class="form-control form-control-sm w-25 text-end">
                                <span class="fw-semibold">$<?= number_format($subtotal, 0, ',', '.') ?></span>
                            </li>
                        <?php endforeach; ?>
                        <li class="list-group-item d-flex justify-content-between bg-light fw-bold">
                            <span>Total:</span>
                            <span>$<?= number_format($total, 0, ',', '.') ?></span>
                        </li>
                    </ul>
                </div>

                <!-- Formulario comprador -->
                <div class="col-md-6 ps-4">
                    <h5 class="mb-3">Datos del Comprador</h5>

                    <div class="mb-3">
                        <label class="form-label">Nombre completo</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="text" class="form-control" name="phone" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Comentarios (opcional)</label>
                        <textarea class="form-control" name="comments" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Confirmar Pedido</button>
                </div>
            </div>
        </form>
    <?php else: ?>
        <div class="alert alert-info text-center">
            Tu carrito está vacío.
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../layout/footer_dashboard.php'; ?>