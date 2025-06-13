<?php
require_once __DIR__ . '/../models/User.php';

class UserController
{
    private $userModel;

    public function __construct()
    {
        $conexion = Database::connect();
        $this->userModel = new User($conexion);
    }

    public function registro()
    {
        require_once __DIR__ . '/../views/user/registro.php';
    }

    public function registrar()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = $_POST['role'];  // Asumimos que viene de un formulario.

        $resultado = $this->userModel->registrar($name, $email, $password, $role);

        if ($resultado) {
            header('Location: index.php?action=registroExitoso');
        } else {
            echo "Error al registrar el usuario.";
        }
    }
}
