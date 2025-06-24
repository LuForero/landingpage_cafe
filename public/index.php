<?php
session_start();

require_once __DIR__ . '/../config/database.php';

// Conexión a la base de datos
$conexion = Database::connect();

// Obtener controlador y acción desde la URL
$controller = $_GET['controller'] ?? 'home';
$action     = $_GET['action'] ?? 'index';

switch ($controller) {
    // -------- HOME --------
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
                echo "<h2>Acción no encontrada (home)</h2>";
        }
        break;

    // -------- FARMER --------
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

    // -------- AUTH --------
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

    // -------- PRODUCT --------
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
            case 'exportSalesCSV':
                $productController->exportSalesCSV();
                break;
            default:
                echo "<h2>Acción no encontrada (product)</h2>";
        }
        break;

    // -------- USER --------
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

    // -------- CART (Carrito de Compras) --------
    case 'cart':
        require_once __DIR__ . '/../controllers/CartController.php';
        $cartController = new CartController($conexion);

        switch ($action) {
            case 'index':
                $cartController->index();
                break;
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
                $cartController->checkout();
                break;
            case 'thankyou':
                require_once __DIR__ . '/../views/cart/thankyou.php';
                break;
            default:
                echo "<h2>Acción no encontrada (cart)</h2>";
                break;
        }
        break;


    // -------- DEFAULT --------
    default:
        echo "<h2>Controlador no encontrado</h2>";
        break;
}
