<?php
require_once __DIR__ . '/../layout/header_dashboard.php';

// ✅ Iniciar sesión solo si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Order.php';

$db = Database::connect();
$orderModel = new Order($db);

// ✅ Verificar que hay productos en el carrito
if (empty($_SESSION['cart'])) {
    echo "<div class='alert alert-warning text-center'>No hay productos en el carrito para procesar el pago.</div>";
    require_once __DIR__ . '/../layout/footer_dashboard.php';
    exit();
}

// ✅ Actualizar cantidades del carrito si vienen desde el formulario
if (isset($_POST['quantities']) && is_array($_POST['quantities'])) {
    foreach ($_POST['quantities'] as $productId => $qty) {
        $productId = (int) $productId;
        $qty = max(1, (int) $qty); // Asegurar cantidad mínima 1
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity'] = $qty;
        }
    }
}

// ✅ Capturar los datos del formulario
$name     = trim($_POST['name'] ?? '');
$email    = trim($_POST['email'] ?? '');
$phone    = trim($_POST['phone'] ?? '');
$comments = trim($_POST['comments'] ?? '');

// ✅ Validar campos obligatorios
if ($name === '' || $email === '' || $phone === '') {
    echo "<div class='alert alert-danger text-center'>Por favor completa todos los campos obligatorios.</div>";
    require_once __DIR__ . '/../layout/footer_dashboard.php';
    exit();
}

// ✅ Crear orden como pagada
$orderId = $orderModel->createPaidOrder($name, $email, $phone, $comments);
?>

<style>
    body {
        background-image: url('public/img/img-fondo-formulario.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 100vh;
        margin: 0;
        padding: 0;
    }

    .payment-container {
        background-color: rgba(255, 255, 255, 0.95);
        border-radius: 16px;
        padding: 40px;
        max-width: 600px;
        margin: 80px auto;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        text-align: center;
        color: #000;
    }
</style>

<?php if ($orderId): ?>
    <?php unset($_SESSION['cart']); ?>
    <div class="payment-container">
        <h2 class="text-success">¡Pago exitoso!</h2>
        <p class="mt-3">Gracias por tu compra. Tu pedido ha sido registrado correctamente.</p>
        <a href="index.php?controller=home&action=index" class="btn btn-primary mt-3">Volver al inicio</a>
    </div>
<?php else: ?>
    <div class="payment-container">
        <h2 class="text-danger">Error al procesar el pago</h2>
        <p>Ocurrió un problema al registrar tu orden. Intenta nuevamente.</p>
        <a href="index.php?controller=cart&action=checkout" class="btn btn-warning mt-3">Volver al carrito</a>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../layout/footer_dashboard.php'; ?>