<?php

require_once __DIR__ . '/../models/User.php';

class AuthController
{
    private $userModel;

    public function __construct($conexion)
    {
        $this->userModel = new User($conexion);
    }

    public function login()
    {
        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function iniciarSesion()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->userModel->getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['name'] = $user['name'];

            if ($user['role'] === 'admin') {
                header('Location: index.php?controller=admin&action=dashboard');
            } else {
                header('Location: index.php?controller=farmers&action=dashboard');
            }
            exit();
        } else {
            $error = "Correo o contraseña incorrectos";
            require_once __DIR__ . '/../views/auth/login.php';
        }
    }

    // Métodos que estaban generando error:

    public function forgotPassword()
    {
        require_once __DIR__ . '/../views/auth/forgot_password.php';
    }

    public function sendResetEmail()
    {
        echo "Función de envío de email de recuperación (pendiente por implementar)";
    }

    public function resetPassword()
    {
        echo "Función de restablecimiento de contraseña (pendiente por implementar)";
    }
}
