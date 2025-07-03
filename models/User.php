<?php

class User
{
    private $db;

    // Constructor: recibe y almacena la conexión a la base de datos
    // Constructor: receives and stores the database connection
    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    /**
     * Buscar un usuario por su email
     * Find a user by their email (for login and password reset)
     */
    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Registrar un nuevo usuario (versión básica)
     * Register a new user (basic version, used if open registration is enabled)
     */
    public function index($name, $email, $password, $role = 'farmer')
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (name, email, password, role) 
                  VALUES (:name, :email, :password, :role)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hash);
        $stmt->bindParam(':role', $role);

        return $stmt->execute();
    }

    /**
     * Guardar token de recuperación de contraseña
     * Save password recovery token
     */
    public function saveResetToken($email, $token)
    {
        $query = "UPDATE users SET reset_token = :token WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    /**
     * Buscar usuario por token
     * Get user by reset token
     */
    public function getUserByToken($token)
    {
        $query = "SELECT * FROM users WHERE reset_token = :token LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Actualizar la contraseña de un usuario
     * Update user's password
     */
    public function updatePassword($userId, $newPassword)
    {
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);
        $query = "UPDATE users SET password = :password, reset_token = NULL WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':password', $hash);
        $stmt->bindParam(':id', $userId);
        return $stmt->execute();
    }

    /**
     * Obtener todos los usuarios
     * Get all users
     */
    public function obtenerTodos()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Registrar usuario (desde formulario de administrador)
     * Register user (from admin panel or manual form)
     */
    public function registrar($name, $email, $passwordHasheado, $role)
    {
        $query = "INSERT INTO users (name, email, password, role)
                  VALUES (:name, :email, :password, :role)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $passwordHasheado); // Contraseña ya viene hasheada / Password is already hashed
        $stmt->bindParam(':role', $role);

        return $stmt->execute();
    }

    /**
     * Obtener un usuario por su ID
     * Get user by ID
     */
    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Actualizar datos de un usuario
     * Update user information
     */
    public function update($id, $name, $email, $role)
    {
        $query = "UPDATE users SET name = :name, email = :email, role = :role WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':role', $role);
        return $stmt->execute();
    }

    /**
     * Eliminar un usuario por su ID
     * Delete user by ID
     */
    public function delete($id)
    {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
