<?php
require_once __DIR__ . '/../models/User.php';

class UserController
{
    private $userModel;

    // Constructor: Inicializa el modelo de usuario con la conexión a la base de datos
    // Constructor: Initializes the User model with the database connection
    public function __construct()
    {
        $conexion = Database::connect();
        $this->userModel = new User($conexion);
    }

    // Mostrar la lista de usuarios
    // Display the list of users
    public function index()
    {
        $usuarios = $this->userModel->obtenerTodos();
        require_once __DIR__ . '/../views/user/index.php';
    }

    // Registrar nuevo usuario
    // Register new user
    public function registrar()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // ✅ Importante encriptar la contraseña / Encrypting the password is essential
        $role = $_POST['role'];

        $resultado = $this->userModel->registrar($name, $email, $password, $role);

        if ($resultado) {
            header('Location: index.php?controller=user&action=index&exito=1');
            exit;
        } else {
            echo "Error al registrar el usuario."; // Error registering user
        }
    }

    // Mostrar formulario para crear nuevo usuario
    // Show form to create a new user
    public function create()
    {
        require_once __DIR__ . '/../views/user/create.php';
    }

    // Mostrar formulario de edición para un usuario existente
    // Show edit form for an existing user
    public function edit()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $usuario = $this->userModel->getById($id); // Asegúrate que este método exista / Make sure this method exists
            require_once __DIR__ . '/../views/user/edit.php';
        } else {
            echo "ID de usuario no válido."; // Invalid user ID
        }
    }

    // Actualizar los datos del usuario
    // Update user data
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
            echo "Error al actualizar el usuario."; // Error updating user
        }
    }

    // Eliminar usuario
    // Delete user
    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if ($id && $this->userModel->delete($id)) {
            header('Location: index.php?controller=user&action=index');
            exit();
        } else {
            echo "Error al eliminar el usuario."; // Error deleting user
        }
    }
}
