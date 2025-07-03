<?php
// Inicia la sesión para manejar variables de usuario
// Start the session to handle user variables
session_start();

// Importa la configuración de conexión a la base de datos
// Include database connection settings
require_once __DIR__ . '/../config/database.php';

// Conecta a la base de datos
// Connect to the database
$conexion = Database::connect();

// Obtiene el controlador y la acción desde la URL (con valores por defecto)
// Get controller and action from URL (defaults if not provided)
$controller = $_GET['controller'] ?? 'home';
$action     = $_GET['action'] ?? 'index';

// Enrutamiento general
// Main routing
switch ($controller) {

    // ---------- HOME ----------
    case 'home':
        switch ($action) {
            case 'index':
                require_once '../views/home/home.php';
                break;
            case 'registro':
                require_once '../views/home/registro.php';
                break;
            case 'registroExitoso':
                require_once '../views/home/registroExitoso.php';
                break;
            case 'dashboard':
                require_once '../views/home/dashboard.php';
                break;
            default:
                echo "<h2>Acción no encontrada (home)</h2>"; // "Action not found (home)"
        }
        break;

    // ---------- FARMER ----------
    case 'farmer':
        require_once __DIR__ . '/../controllers/FarmerController.php';
        $farmerController = new FarmerController($conexion);

        switch ($action) {
            case 'registrar':
                $farmerController->registrar();
                break;
            case 'listar':
                $farmerController->listar();
                break;
            case 'exportar':
                $farmerController->exportarCSV();
                break;
            default:
                echo "<h2>Acción no encontrada (farmer)</h2>";
        }
        break;

    // ---------- AUTH (Autenticación) ----------
    case 'auth':
        require_once __DIR__ . '/../controllers/AuthController.php';
        $authController = new AuthController($conexion);

        switch ($action) {
            case 'login':
                $authController->login();
                break;
            case 'loginPost':
                $authController->iniciarSesion();
                break;
            case 'logout':
                $authController->logout();
                break;
            case 'forgotPassword':
                $authController->forgotPassword();
                break;
            case 'resetPassword':
                $authController->resetPassword();
                break;
            case 'sendResetEmail':
                $authController->sendResetEmail();
                break;
            default:
                echo "<h2>Acción no encontrada (auth)</h2>";
        }
        break;

    // ---------- PRODUCT ----------
    case 'product':
        require_once __DIR__ . '/../controllers/ProductController.php';
        $productController = new ProductController($conexion);

        switch ($action) {
            case 'index':
                $productController->index();
                break;
            case 'create':
                $productController->create();
                break;
            case 'store':
                $productController->store();
                break;
            case 'edit':
                $productController->edit();
                break;
            case 'update':
                $productController->update();
                break;
            case 'delete':
                $productController->delete();
                break;
            case 'salesHistory':
                $productController->salesHistory();
                break;
            case 'markAsPaid':
                $productController->markAsPaid(); // ✅ Marca la orden como pagada
                break;
            case 'exportSalesCSV':
                $productController->exportSalesCSV();
                break;
            default:
                echo "<h2>Acción no encontrada (product)</h2>";
        }
        break;

    // ---------- USER ----------
    case 'user':
        require_once __DIR__ . '/../controllers/UserController.php';
        $userController = new UserController($conexion);

        switch ($action) {
            case 'index':
                $userController->index();
                break;
            case 'create':
                $userController->create();
                break;
            case 'registrar':
                $userController->registrar();
                break;
            case 'edit':
                $userController->edit();
                break;
            case 'update':
                $userController->update();
                break;
            case 'delete':
                $userController->delete();
                break;
            default:
                echo "<h2>Acción no encontrada (user)</h2>";
        }
        break;

    // ---------- CART (Carrito de compras) ----------
    case 'cart':
        require_once __DIR__ . '/../controllers/CartController.php';
        $cartController = new CartController($conexion);

        switch ($action) {
            case 'add':
                $cartController->add();
                break;
            case 'remove':
                $cartController->remove();
                break;
            case 'clear':
                $cartController->clear();
                break;
            case 'checkout':
                $cartController->checkout(); // ✅ Muestra formulario de pago
                break;
            case 'checkoutPost':
                $cartController->checkoutPost(); // ✅ Procesa datos del formulario
                break;
            case 'checkoutConfirm':
            case 'confirm':
                $cartController->checkoutConfirm(); // ✅ Simulación de confirmación
                break;
            case 'simulatePayment':
                $cartController->simulatePayment(); // ✅ Marca orden como pagada
                break;
            case 'updateOrderStatus':
                $productController->updateOrderStatus(); // ✅ Cambia estado de orden
                break;
            case 'thankyou':
                $cartController->thankyou(); // ✅ Página de agradecimiento
                break;
            default:
                echo "<h2>Acción no encontrada (cart)</h2>";
        }
        break;

    // ---------- EXTRAS / ERRORES ----------
    case 'updateOrderStatus':
        $productController->updateOrderStatus(); // Posible redundancia (ya está en cart)
        break;

    case 'checkoutPost':
        $cartController->checkoutPost(); // También redundante, está en cart
        break;

    default:
        echo "<h2>Controlador no encontrado</h2>"; // Default case: Controller not found
        break;
}
