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

    public function index()
    {
        $usuarios = $this->userModel->obtenerTodos();
        require_once __DIR__ . '/../views/user/index.php';
    }

    public function registrar()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // ✅ ESTA LÍNEA ES CLAVE
        $role = $_POST['role'];

        $resultado = $this->userModel->registrar($name, $email, $password, $role);

        if ($resultado) {
            header('Location: index.php?controller=user&action=index&exito=1');
            exit;
        } else {
            echo "Error al registrar el usuario.";
        }
    }

    public function create()
    {
        require_once __DIR__ . '/../views/user/create.php';
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $usuario = $this->userModel->getById($id);  // Asegúrate de tener este método en el modelo
            require_once __DIR__ . '/../views/user/edit.php';
        } else {
            echo "ID de usuario no válido.";
        }
    }

    public function update()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        $resultado = $this->userModel->update($id, $name, $email, $role);

        if ($resultado) {
            header('Location: index.php?controller=user&action=index');
        } else {
            echo "Error al actualizar el usuario.";
        }
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if ($id && $this->userModel->delete($id)) {
            header('Location: index.php?controller=user&action=index');
            exit();
        } else {
            echo "Error al eliminar el usuario.";
        }
    }
}
