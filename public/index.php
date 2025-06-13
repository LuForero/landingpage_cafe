<?php
// Iniciaremos la sesión si más adelante manejamos login
session_start();

// Incluimos la base de datos y los controladores
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../controllers/FarmerController.php';

// Conectamos a la base de datos
$conexion = Database::connect();

// Obtenemos la acción desde la URL
$action = $_GET['action'] ?? 'home';

// Según la acción, cargamos la vista o ejecutamos el controlador
switch ($action) {
    case 'home':
        require_once '../views/home/home.php';
        break;

    case 'registro':
        require_once '../views/home/registro.php';
        break;

    case 'registrar':
        $controller = new FarmerController($conexion);
        $controller->registrar();
        break;

    case 'registroExitoso':
        require_once '../views/home/registroExitoso.php';
        break;


    default:
        echo "<h2>Página no encontrada</h2>";
        break;

    case 'login':
        require_once '../views/auth/login.php';
        break;

    case 'loginPost':
        $controller = new AuthController($conexion);
        $controller->login();
        break;
}
