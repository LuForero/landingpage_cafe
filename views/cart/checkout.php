<?php require_once __DIR__ . '/../layout/header_dashboard.php'; ?>
<!-- Cabecera común del dashboard / Dashboard header -->

<style>
    /* Fondo y contenedor estilizado / Background and styled container */
    body {
        background-image: url('img/img-fondo-formulario.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 100vh;
    }

    .checkout-container {
        background-color: rgba(255, 255, 255, 0.95);
        /* Fondo blanco translúcido / White semi-transparent background */
        border-radius: 12px;
        padding: 40px;
        max-width: 900px;
        margin: 50px auto;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        /* Sombra / Shadow */
    }
</style>

<!-- Contenedor principal del checkout / Main container -->
<div class="checkout-container text-center">
    <h2 class="mb-4">Finalizar Compra / Checkout</h2>

    <?php if (!empty($_SESSION['cart'])): ?>
        <!-- Formulario de envío de orden / Order submission form -->
        <form action="index.php?controller=cart&action=simulatePayment" method="POST">
            <div class="row text-start">
                <!-- 🛒 Columna: Lista de productos / Products summary -->
                <div class="col-md-6 border-end pe-4">
                    <h5 class="mb-3">Productos Facturados / Invoiced Products</h5>

                    <ul class="list-group mb-3" id="product-list">
                        <?php $total = 0; ?>
                        <?php foreach ($_SESSION['cart'] as $item): ?>
                            <?php $subtotal = $item['price'] * $item['quantity']; ?>
                            <?php $total += $subtotal; ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <!-- Nombre del producto / Product name -->
                                <div class="w-50">
                                    <?= htmlspecialchars($item['name']) ?>
                                </div>

                                <!-- Campo cantidad modificable / Editable quantity -->
                                <input type="number"
                                    name="quantities[<?= $item['id'] ?>]"
                                    value="<?= $item['quantity'] ?>"
                                    min="1"
                                    class="form-control form-control-sm w-25 text-end quantity-input"
                                    data-price="<?= $item['price'] ?>"
                                    data-subtotal-id="subtotal-<?= $item['id'] ?>">

                                <!-- Subtotal por producto / Subtotal per product -->
                                <span class="fw-semibold" id="subtotal-<?= $item['id'] ?>">
                                    $<?= number_format($subtotal, 0, ',', '.') ?>
                                </span>
                            </li>
                        <?php endforeach; ?>

                        <!-- Total general / Total amount -->
                        <li class="list-group-item d-flex justify-content-between bg-light fw-bold">
                            <span>Total:</span>
                            <span id="total-display">$<?= number_format($total, 0, ',', '.') ?></span>
                        </li>
                    </ul>

                    <!-- Total oculto para enviar / Hidden total to submit -->
                    <input type="hidden" name="total" id="total-hidden" value="<?= $total ?>">
                </div>

                <!-- 🧍‍♂️ Formulario de comprador / Buyer form -->
                <div class="col-md-6 ps-4">
                    <h5 class="mb-3">Datos del Comprador / Buyer Information</h5>

                    <div class="mb-3">
                        <label class="form-label">Nombre completo / Full Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Correo electrónico / Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Teléfono / Phone</label>
                        <input type="text" class="form-control" name="phone" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Comentarios (opcional) / Comments (optional)</label>
                        <textarea class="form-control" name="comments" rows="3"></textarea>
                    </div>

                    <!-- Botón de confirmación / Submit button -->
                    <button type="submit" class="btn btn-success w-100">Confirmar Pedido / Confirm Order</button>
                </div>
            </div>
        </form>

        <!-- ✅ Script: Actualización de totales / Totals auto-update -->
        <script>
            const inputs = document.querySelectorAll('.quantity-input');
            const totalDisplay = document.getElementById('total-display');
            const totalHidden = document.getElementById('total-hidden');

            function updateTotals() {
                let total = 0;

                inputs.forEach(input => {
                    const quantity = parseInt(input.value) || 0;
                    const price = parseFloat(input.dataset.price);
                    const subtotal = quantity * price;
                    total += subtotal;

                    const subtotalId = input.dataset.subtotalId;
                    document.getElementById(subtotalId).textContent = `$${subtotal.toLocaleString('es-CO')}`;
                });

                totalDisplay.textContent = `$${total.toLocaleString('es-CO')}`;
                totalHidden.value = total;
            }

            // Detectar cambios en cantidad / Listen for quantity changes
            inputs.forEach(input => {
                input.addEventListener('input', updateTotals);
            });
        </script>

    <?php else: ?>
        <!-- Mensaje cuando no hay productos / Empty cart message -->
        <div class="alert alert-info text-center">
            Tu carrito está vacío. / Your cart is empty.
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../layout/footer_dashboard.php'; ?>
<!-- Pie de página del dashboard / Dashboard footer -->