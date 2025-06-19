<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/User.php';

$conexion = Database::connect();
$userModel = new User($conexion);

$email = 'admin@hotmail.com';
$newPassword = '12345';

// Buscar el usuario
$user = $userModel->getUserByEmail($email);

if ($user) {
    $userModel->updatePassword($user['id'], $newPassword);
    echo "✅ Contraseña actualizada correctamente para admin@hotmail.com.";
} else {
    echo "❌ Usuario no encontrado.";
}
