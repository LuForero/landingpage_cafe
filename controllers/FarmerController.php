<?php

require_once __DIR__ . '/../models/Farmer.php';

class FarmerController
{
  private $db;
  private $farmerModel;

  public function __construct($conexion)
  {
    $this->db = $conexion;
    $this->farmerModel = new Farmer($conexion);
  }

  public function registrar()
  {
    // Obtenemos los datos del formulario
    $name = $_POST['name'];
    $sidewalk = $_POST['sidewalk'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $description = $_POST['description'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Llamamos al modelo para registrar
    $exito = $this->farmerModel->registrar($name, $sidewalk, $email, $phone, $description, $password);

    if ($exito) {
      header("Location: index.php?action=registroExitoso");
      exit();
    } else {
      echo "Error al registrar el caficultor.";
    }
  }
}
