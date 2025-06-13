<?php

class User
{
    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    // Buscar usuario por email (para login y recuperación de contraseña)
    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Registrar nuevo usuario (por si más adelante habilitamos registro directo)
    public function registrar($name, $email, $password, $role = 'farmer')
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

    // Guardar token para recuperación de contraseña
    public function saveResetToken($email, $token)
    {
        $query = "UPDATE users SET reset_token = :token WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    // Buscar usuario por token de recuperación
    public function getUserByToken($token)
    {
        $query = "SELECT * FROM users WHERE reset_token = :token LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar nueva contraseña
    public function updatePassword($userId, $newPassword)
    {
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);
        $query = "UPDATE users SET password = :password, reset_token = NULL WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':password', $hash);
        $stmt->bindParam(':id', $userId);
        return $stmt->execute();
    }
}
