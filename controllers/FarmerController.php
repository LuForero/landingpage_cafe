<?php
require_once __DIR__ . '/../models/Farmer.php'; // Carga el modelo del caficultor / Load the Farmer model

class FarmerController
{
  private $farmerModel;
  private $db;

  public function __construct($conexion)
  {
    $this->db = $conexion; // Guarda la conexión a la base de datos / Store DB connection
    $this->farmerModel = new Farmer($conexion); // Crea instancia del modelo Farmer / Create instance of Farmer model
  }

  // 📌 Método para registrar un caficultor / Method to register a coffee grower
  public function registrar()
  {
    // Recibimos los datos del formulario / Get form data
    $name = $_POST['name'];
    $location_type = $_POST['location_type'];
    $sidewalk = $_POST['sidewalk'];
    $email = !empty($_POST['email']) ? $_POST['email'] : null;
    $phone = $_POST['phone'];
    $description = $_POST['description'];
    // $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Si se necesita contraseña / Uncomment if password is needed

    // Validamos que los campos obligatorios vengan llenos / Validate required fields
    if (empty($name) || empty($location_type) || empty($sidewalk) || empty($phone) || empty($description)) {
      echo "Todos los campos son obligatorios excepto el email.";
      echo "All fields are required except email.";
      exit();
    }

    // Validar duplicado de email SOLO si se ingresó / Validate duplicate email ONLY if it was entered
    if (!empty($email)) {
      $stmt = $this->db->prepare("SELECT * FROM farmers WHERE email = :email");
      $stmt->bindParam(':email', $email);
      $stmt->execute();

      if ($stmt->rowCount() > 0) {
        // Redirige con error si ya existe ese correo / Redirect with error if email exists
        header('Location: index.php?action=registroExitoso&error=correo');
        exit();
      }
    }

    // Llamar método del modelo para guardar / Call model method to insert record
    $resultado = $this->farmerModel->registrar($name, $location_type, $sidewalk, $email, $phone, $description);

    if ($resultado) {
      // Redirige al mensaje de éxito / Redirect to success message
      header('Location: index.php?action=registroExitoso');
      exit();
    } else {
      echo "Error al registrar el caficultor.";
      echo "Error registering the coffee grower.";
    }
  }

  // 📄 Método para listar caficultores / Method to list coffee growers
  public function listar()
  {
    $farmers = $this->farmerModel->getAll(); // Obtener todos los registros / Get all farmers
    require_once __DIR__ . '/../views/farmer/lista.php'; // Cargar vista / Load view
  }

  // 📤 Método para exportar los datos de caficultores a CSV / Export coffee grower data to CSV
  public function exportarCSV()
  {
    $farmers = $this->farmerModel->getAll(); // Asegúrate de tener este método en el modelo / Make sure this exists in model

    // Encabezados para descarga CSV / CSV headers for download
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=farmers.csv');

    $output = fopen('php://output', 'w'); // Abrir salida directa / Open direct output

    // Escribir encabezados del archivo / Write CSV headers
    fputcsv($output, ['ID', 'Nombre', 'Tipo Ubicación', 'Vereda/Municipio', 'Correo', 'Teléfono', 'Descripción', 'Fecha']);

    // Escribir filas con datos / Write rows with farmer data
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

    fclose($output); // Cerrar salida / Close output
    exit; // Finaliza la exportación / End process
  }
}
