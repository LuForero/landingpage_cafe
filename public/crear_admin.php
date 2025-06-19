<?php
require_once __DIR__ . '/../config/database.php';

$conexion = Database::connect();

$name = 'Administrador';
$email = 'admin@hotmail.com';
$password = '12345'; // Contraseña en texto plano
$role = 'admin';

// Verifica si el usuario ya existe
$sqlCheck = "SELECT COUNT(*) FROM users WHERE email = :email";
$stmtCheck = $conexion->prepare($sqlCheck);
$stmtCheck->bindParam(':email', $email);
$stmtCheck->execute();
$count = $stmtCheck->fetchColumn();

if ($count > 0) {
    echo "⚠️ Ya existe un usuario con el correo $email";
    exit;
}

// Hashea la contraseña
$hash = password_hash($password, PASSWORD_DEFAULT);

// Inserta el usuario admin
$sqlInsert = "INSERT INTO users (name, email, password, role, created_at)
              VALUES (:name, :email, :password, :role, NOW())";

$stmt = $conexion->prepare($sqlInsert);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $hash);
$stmt->bindParam(':role', $role);

if ($stmt->execute()) {
    echo "✅ Admin creado correctamente con correo: $email y contraseña: $password";
} else {
    echo "❌ Error al crear admin.";
}
