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
        $user = $this->userModel->getUserByEmail($email);

        if (!$user) {
            echo "No se encontró usuario con ese correo.";
            var_dump($email);
            exit;
        }

        if (!password_verify($password, $user['password'])) {
            echo "La contraseña no coincide.";
            var_dump($password);
            var_dump($user['password']);
            exit;
        }


        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['name'] = $user['name'];

            // Redirige a la bienvenida general
            header('Location: index.php?controller=home&action=dashboard');
            exit();
        } else {
            $error = "Correo o contraseña incorrectos";
            require_once __DIR__ . '/../views/auth/login.php';
        }
    }

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
    public function logout()
    {
        session_destroy();
        header('Location: index.php?controller=home&action=index');
        exit();
    }
}
