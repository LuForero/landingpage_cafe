<?php

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../vendor/autoload.php'; // Solo una vez y afuera de cualquier clase

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AuthController
{
    private $db;
    private $userModel;

    public function __construct($conexion)
    {
        $this->db = $conexion;
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
        $email = $_POST['email'] ?? '';

        if (empty($email)) {
            echo "Por favor ingresa tu correo.";
            return;
        }

        $user = $this->userModel->getUserByEmail($email);

        if (!$user) {
            echo "Usuario no encontrado.";
            return;
        }

        // Generar código de 6 dígitos
        $token = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Guardar token y expiración (5 minutos)
        $this->userModel->saveResetToken($email, $token);

        // Configuración del correo
        $config = require __DIR__ . '/../config/mail_config.php';

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = $config['host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $config['username'];
            $mail->Password   = $config['password'];
            $mail->SMTPSecure = $config['secure'];
            $mail->Port       = $config['port'];

            $mail->setFrom($config['from_email'], $config['from_name']);
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Código para restablecer tu contraseña';
            $mail->Body    = "Tu código para restablecer la contraseña es: <h2>$token</h2>.<br>
                          Este código expira en 10 minutos.";

            $mail->send();
            echo "Código de recuperación enviado correctamente a tu correo.";
        } catch (Exception $e) {
            echo "No se pudo enviar el correo. Error: {$mail->ErrorInfo}";
        }
        $_SESSION['reset_email'] = $email;
        $_SESSION['success_message'] = "Código de recuperación enviado correctamente a tu correo.";
        header('Location: index.php?controller=auth&action=resetPassword');
        exit;
    }

    public function resetPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            require_once __DIR__ . '/../views/auth/reset_password.php';
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $token = $_POST['token'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirm = $_POST['confirm_password'] ?? '';

            if (empty($email) || empty($token) || empty($password) || empty($confirm)) {
                $_SESSION['reset_error'] = "Todos los campos son obligatorios.";
                header("Location: index.php?controller=auth&action=resetPassword");
                exit;
            }

            if ($password !== $confirm) {
                $_SESSION['reset_error'] = "Las contraseñas no coinciden.";
                header("Location: index.php?controller=auth&action=resetPassword");
                exit;
            }

            $user = $this->userModel->getUserByEmail($email);
            if (!$user || $user['reset_token'] !== $token) {
                $_SESSION['reset_error'] = "Código inválido o correo incorrecto.";
                header("Location: index.php?controller=auth&action=resetPassword");
                exit;
            }

            $this->userModel->updatePassword($user['id'], $password);
            unset($_SESSION['reset_email']);
            $_SESSION['success_message'] = "Contraseña actualizada correctamente. Ya puedes iniciar sesión.";
            header("Location: index.php?controller=auth&action=login");
            exit;
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: index.php?controller=home&action=index');
        exit();
    }
}
