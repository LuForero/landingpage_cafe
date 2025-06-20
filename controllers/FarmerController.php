<?php
require_once __DIR__ . '/../models/Farmer.php';

class FarmerController
{
  private $farmerModel;
  private $db;

  public function __construct($conexion)
  {
    $this->db = $conexion;
    $this->farmerModel = new Farmer($conexion);
  }

  public function registrar()
  {
    // Recibimos los datos del formulario
    $name = $_POST['name'];
    $location_type = $_POST['location_type'];
    $sidewalk = $_POST['sidewalk'];
    $email = !empty($_POST['email']) ? $_POST['email'] : null;
    $phone = $_POST['phone'];
    $description = $_POST['description'];
    //$password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Si quieres usar password, descomenta esta línea.

    // Validamos que los campos obligatorios vengan llenos (doble validación)
    if (empty($name) || empty($location_type) || empty($sidewalk) || empty($phone) || empty($description)) {
      echo "Todos los campos son obligatorios excepto el email.";
      exit();
    }

    // Validar duplicado de email SOLO si lo ingresaron
    if (!empty($email)) {
      $stmt = $this->db->prepare("SELECT * FROM farmers WHERE email = :email");
      $stmt->bindParam(':email', $email);
      $stmt->execute();

      if ($stmt->rowCount() > 0) {
        header('Location: index.php?action=registroExitoso&error=correo');
        exit();
      }
    }

    // Llamamos el método del modelo (ya no enviamos password por ahora)
    $resultado = $this->farmerModel->registrar($name, $location_type, $sidewalk, $email, $phone, $description);

    if ($resultado) {
      header('Location: index.php?action=registroExitoso');
      exit();
    } else {
      echo "Error al registrar el caficultor.";
    }
  }
  public function listar()
  {
    $farmers = $this->farmerModel->getAll();
    require_once __DIR__ . '/../views/farmer/lista.php';
  }
  
  public function exportarCSV()
  {
    $farmers = $this->farmerModel->getAll(); // Asegúrate de tener este método en el modelo

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=farmers.csv');

    $output = fopen('php://output', 'w');

    // Encabezados del archivo
    fputcsv($output, ['ID', 'Nombre', 'Tipo Ubicación', 'Vereda/Municipio', 'Correo', 'Teléfono', 'Descripción', 'Fecha']);

    // Datos
    foreach ($farmers as $farmer) {
      fputcsv($output, [
        $farmer['id'],
        $farmer['name'],
        $farmer['location_type'],
        $farmer['sidewalk'],
        $farmer['email'],
        $farmer['phone'],
        $farmer['description'],
        $farmer['created_at']
      ]);
    }

    fclose($output);
    exit;
  }
}
