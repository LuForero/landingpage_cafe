<?php
session_start();

// Incluimos la base de datos
require_once __DIR__ . '/../config/database.php';

// Conexión a la base de datos
$conexion = Database::connect();

// Obtenemos el controlador y acción
$controller = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'index';

// Según el controlador, incluimos los controladores necesarios
switch ($controller) {
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
            default:
                echo "<h2>Página no encontrada (home)</h2>";
                break;
        }
        break;

    case 'farmer':
        require_once __DIR__ . '/../controllers/FarmerController.php';
        $farmerController = new FarmerController($conexion);
        if ($action == 'registrar') {
            $farmerController->registrar();
        } else {
            echo "<h2>Acción no encontrada (farmer)</h2>";
        }
        break;


    case 'auth':
        require_once __DIR__ . '/../controllers/AuthController.php';
        $authController = new AuthController($conexion);

        if ($action == 'login') {
            $authController->login();
        } elseif ($action == 'loginPost') {
            $authController->iniciarSesion();
        } elseif ($action == 'forgotPassword') {
            $authController->forgotPassword();
        } elseif ($action == 'resetPassword') {
            $authController->resetPassword();
        } elseif ($action == 'sendResetEmail') {
            $authController->sendResetEmail();
        } else {
            echo "<h2>Acción no encontrada (auth)</h2>";
        }
        break;

    case 'product':
        require_once __DIR__ . '/../controllers/ProductController.php';
        $productController = new ProductController($conexion);

        if ($action == 'index') {
            $productController->index();
        } elseif ($action == 'create') {
            $productController->create();
        } elseif ($action == 'store') {
            $productController->store();
        } elseif ($action == 'edit') {
            $productController->edit();
        } elseif ($action == 'update') {
            $productController->update();
        } elseif ($action == 'delete') {
            $productController->delete();
        } else {
            echo "<h2>Acción no encontrada (product)</h2>";
        }
        break;
}
