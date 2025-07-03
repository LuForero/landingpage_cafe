<?php

// Includes the User model and PHPMailer dependencies
// Incluye el modelo User y las dependencias de PHPMailer
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// AuthController handles login, password recovery, and logout
// AuthController gestiona el inicio de sesión, recuperación de contraseña y cierre de sesión
class AuthController
{
    private $db;
    private $userModel;

    // Constructor: receives a database connection and creates a User model instance
    // Constructor: recibe una conexión a la base de datos y crea una instancia del modelo User
    public function __construct($conexion)
    {
        $this->db = $conexion;
        $this->userModel = new User($conexion);
    }

    // Loads the login form view
    // Carga la vista del formulario de inicio de sesión
    public function login()
    {
        require_once __DIR__ . '/../views/auth/login.php';
    }

    // Processes login form submission
    // Procesa el envío del formulario de inicio de sesión
    public function iniciarSesion()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // Retrieves user data from the database by email
        // Recupera los datos del usuario desde la base de datos por correo
        $user = $this->userModel->getUserByEmail($email); // (esta línea está repetida innecesariamente)

        // If the user is not found, stop the process
        // Si no se encuentra el usuario, detiene el proceso
        if (!$user) {
            echo "No se encontró usuario con ese correo."; // "No user found with this email."
            var_dump($email);
            exit;
        }

        // If password does not match, stop the process
        // Si la contraseña no coincide, detiene el proceso
        if (!password_verify($password, $user['password'])) {
            echo "La contraseña no coincide."; // "Password does not match."
            var_dump($password);
            var_dump($user['password']);
            exit;
        }

        // If everything matches, create the session and redirect to dashboard
        // Si todo coincide, crea la sesión y redirige al panel de control
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['name'] = $user['name'];

            header('Location: index.php?controller=home&action=dashboard');
            exit();
        } else {
            $error = "Correo o contraseña incorrectos"; // "Incorrect email or password"
            require_once __DIR__ . '/../views/auth/login.php';
        }
    }

    // Loads the forgot password form
    // Carga la vista del formulario de recuperación de contraseña
    public function forgotPassword()
    {
        require_once __DIR__ . '/../views/auth/forgot_password.php';
    }

    // Sends a reset code to the user's email
    // Envía un código de restablecimiento al correo del usuario
    public function sendResetEmail()
    {
        $email = $_POST['email'] ?? '';

        if (empty($email)) {
            echo "Por favor ingresa tu correo."; // "Please enter your email."
            return;
        }

        $user = $this->userModel->getUserByEmail($email);

        if (!$user) {
            echo "Usuario no encontrado."; // "User not found."
            return;
        }

        // Generates a 6-digit token
        // Genera un token de 6 dígitos
        $token = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Stores token and sets expiration time (5 minutes)
        // Guarda el token y establece tiempo de expiración (5 minutos)
        $this->userModel->saveResetToken($email, $token);

        // Loads mail configuration
        // Carga la configuración del correo
        $config = require __DIR__ . '/../config/mail_config.php';

        $mail = new PHPMailer(true);

        try {
            // Mailer settings
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host       = $config['host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $config['username'];
            $mail->Password   = $config['password'];
            $mail->SMTPSecure = $config['secure'];
            $mail->Port       = $config['port'];

            // Sender and recipient
            // Remitente y destinatario
            $mail->setFrom($config['from_email'], $config['from_name']);
            $mail->addAddress($email);

            // Email content
            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Código para restablecer tu contraseña';
            $mail->Body    = "Tu código para restablecer la contraseña es: <h2>$token</h2>.<br>
                              Este código expira en 10 minutos.";

            $mail->send();
            echo "Código de recuperación enviado correctamente a tu correo.";
        } catch (Exception $e) {
            echo "No se pudo enviar el correo. Error: {$mail->ErrorInfo}";
        }

        // Stores the email in session for use in the reset form
        // Guarda el correo en sesión para usarlo en el formulario de restablecimiento
        $_SESSION['reset_email'] = $email;
        $_SESSION['success_message'] = "Código de recuperación enviado correctamente a tu correo.";
        header('Location: index.php?controller=auth&action=resetPassword');
        exit;
    }

    // Loads or processes the password reset form
    // Carga o procesa el formulario de restablecimiento de contraseña
    public function resetPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            require_once __DIR__ . '/../views/auth/reset_password.php';
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $token = $_POST['token'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirm = $_POST['confirm_password'] ?? '';

            // Checks that no fields are empty
            // Verifica que ningún campo esté vacío
            if (empty($email) || empty($token) || empty($password) || empty($confirm)) {
                $_SESSION['reset_error'] = "Todos los campos son obligatorios.";
                header("Location: index.php?controller=auth&action=resetPassword");
                exit;
            }

            // Confirms password and confirmation match
            // Confirma que la contraseña y su confirmación coinciden
            if ($password !== $confirm) {
                $_SESSION['reset_error'] = "Las contraseñas no coinciden.";
                header("Location: index.php?controller=auth&action=resetPassword");
                exit;
            }

            // Verifies the user and token
            // Verifica el usuario y el token
            $user = $this->userModel->getUserByEmail($email);
            if (!$user || $user['reset_token'] !== $token) {
                $_SESSION['reset_error'] = "Código inválido o correo incorrecto.";
                header("Location: index.php?controller=auth&action=resetPassword");
                exit;
            }

            // Updates the password and clears the token
            // Actualiza la contraseña y elimina el token
            $this->userModel->updatePassword($user['id'], $password);
            unset($_SESSION['reset_email']);
            $_SESSION['success_message'] = "Contraseña actualizada correctamente. Ya puedes iniciar sesión.";
            header("Location: index.php?controller=auth&action=login");
            exit;
        }
    }

    // Destroys the session and logs out the user
    // Destruye la sesión y cierra la sesión del usuario
    public function logout()
    {
        session_destroy();
        header('Location: index.php?controller=home&action=index');
        exit();
    }
}
