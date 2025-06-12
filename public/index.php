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
        echo "<h2>¡Registro exitoso!</h2>";
        echo '<a href="index.php" class="btn btn-primary">Volver al inicio</a>';
        break;

    default:
        echo "<h2>Página no encontrada</h2>";
        break;
}
