<?php
// Importa la configuración de la base de datos
// Import database configuration
require_once __DIR__ . '/../config/database.php';

// Importa el modelo de usuario
// Import the User model
require_once __DIR__ . '/../models/User.php';

// Establece la conexión a la base de datos
// Establish database connection
$conexion = Database::connect();

// Crea una instancia del modelo User
// Create an instance of the User model
$userModel = new User($conexion);

// Correo electrónico del usuario a modificar
// Email of the user to update
$email = 'admin@hotmail.com';

// Nueva contraseña que se desea establecer
// New password to be set
$newPassword = '12345';

// Busca al usuario por su correo
// Find the user by email
$user = $userModel->getUserByEmail($email);

// Si el usuario existe, actualiza su contraseña
// If the user exists, update the password
if ($user) {
    $userModel->updatePassword($user['id'], $newPassword);
    echo "✅ Contraseña actualizada correctamente para admin@hotmail.com.";
    // ✅ Password successfully updated for admin@hotmail.com.
} else {
    echo "❌ Usuario no encontrado.";
    // ❌ User not found.
}
