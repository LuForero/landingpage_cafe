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
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->userModel->getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            // Inicio de sesión exitoso
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['name'] = $user['name'];

            // Redirigimos según el rol
            if ($user['role'] === 'admin') {
                header('Location: index.php?action=adminDashboard');
            } else {
                header('Location: index.php?action=farmersDashboard');
            }
            exit();
        } else {
            // Error de login
            header('Location: index.php?action=login&error=login');
            exit();
        }
    }
}
