<?php require_once __DIR__ . '/../layout/header_dashboard.php'; ?>

<style>
    body {
        background-image: url('img/img-fondo-formulario.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 100vh;
    }

    .payment-container {
        background-color: rgba(255, 255, 255, 0.95);
        border-radius: 16px;
        padding: 40px;
        max-width: 600px;
        margin: 80px auto;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    .loader {
        border: 6px solid #f3f3f3;
        border-top: 6px solid #28a745;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        margin: 20px auto;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .btn-finish {
        margin-top: 30px;
        padding: 12px 25px;
        font-size: 16px;
    }
</style>

<div class="payment-container">
    <h2>Simulando Pago...</h2>
    <div class="loader"></div>
    <p class="mt-3">Estamos procesando tu pedido.</p>

    <!-- Simulación de espera con botón -->
    <form action="index.php?controller=cart&action=checkoutPost" method="POST">
        <!-- Reenvío oculto de datos del comprador -->
        <input type="hidden" name="name" value="<?= htmlspecialchars($_POST['name']) ?>">
        <input type="hidden" name="email" value="<?= htmlspecialchars($_POST['email']) ?>">
        <input type="hidden" name="phone" value="<?= htmlspecialchars($_POST['phone']) ?>">
        <input type="hidden" name="comments" value="<?= htmlspecialchars($_POST['comments']) ?>">

        <button type="submit" class="btn btn-success btn-finish">Finalizar Pago</button>
    </form>
</div>

<?php require_once __DIR__ . '/../layout/footer_dashboard.php'; ?>