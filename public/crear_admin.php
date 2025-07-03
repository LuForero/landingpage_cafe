<?php
// Incluye archivo de conexión a la base de datos
// Include database connection file
require_once __DIR__ . '/../config/database.php';

// Conecta a la base de datos
// Connect to the database
$conexion = Database::connect();

// Datos del administrador por defecto
// Default admin user data
$name = 'Administrador';
$email = 'admin@hotmail.com';
$password = '12345'; // Contraseña en texto plano / Plain text password
$role = 'admin';

// Verifica si ya existe un usuario con ese correo
// Check if a user with this email already exists
$sqlCheck = "SELECT COUNT(*) FROM users WHERE email = :email";
$stmtCheck = $conexion->prepare($sqlCheck);
$stmtCheck->bindParam(':email', $email);
$stmtCheck->execute();
$count = $stmtCheck->fetchColumn();

// Si ya existe, muestra mensaje y detiene el script
// If it already exists, display message and exit
if ($count > 0) {
    echo "⚠️ Ya existe un usuario con el correo $email"; // "A user with this email already exists"
    exit;
}

// Hashea la contraseña antes de guardarla
// Hash the password before storing it
$hash = password_hash($password, PASSWORD_DEFAULT);

// Inserta el nuevo usuario administrador en la base de datos
// Insert new admin user into the database
$sqlInsert = "INSERT INTO users (name, email, password, role, created_at)
              VALUES (:name, :email, :password, :role, NOW())";

$stmt = $conexion->prepare($sqlInsert);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $hash); // Usa la contraseña hasheada / Use the hashed password
$stmt->bindParam(':role', $role);

// Muestra mensaje si la inserción fue exitosa o no
// Display message based on success or failure
if ($stmt->execute()) {
    echo "✅ Admin creado correctamente con correo: $email y contraseña: $password";
    // "Admin successfully created with email and password shown"
} else {
    echo "❌ Error al crear admin."; // "Error creating admin"
}
