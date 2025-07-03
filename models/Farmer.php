<?php

class Farmer
{
  private $db;

  // Constructor: Recibe la conexión a la base de datos y la asigna al atributo $db
  // Constructor: Receives the database connection and assigns it to $db
  public function __construct($conexion)
  {
    $this->db = $conexion;
  }

  /**
   * Registrar un nuevo caficultor en la base de datos
   * Registers a new farmer in the database
   *
   * @param string $name          Nombre del caficultor / Farmer's name
   * @param string $location_type Tipo de ubicación (urbano/rural) / Location type (urban/rural)
   * @param string $sidewalk      Vereda o municipio / Sidewalk or town
   * @param string $email         Correo electrónico (opcional) / Email (optional)
   * @param string $phone         Teléfono / Phone
   * @param string $description   Descripción del productor / Producer's description
   * @return bool                 Retorna true si se insertó correctamente, false si hubo error / Returns true if inserted, false on error
   */
  public function registrar($name, $location_type, $sidewalk, $email, $phone, $description)
  {
    try {
      // Consulta preparada para insertar datos en la tabla farmers
      // Prepared statement to insert data into the farmers table
      $stmt = $this->db->prepare("INSERT INTO farmers (name, location_type, sidewalk, email, phone, description) 
                                   VALUES (:name, :location_type, :sidewalk, :email, :phone, :description)");

      // Asociar valores a los parámetros de la consulta
      // Bind values to query parameters
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':location_type', $location_type);
      $stmt->bindParam(':sidewalk', $sidewalk);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':phone', $phone);
      $stmt->bindParam(':description', $description);

      // Ejecutar consulta / Execute query
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      // Mostrar el error para depuración / Show error for debugging
      echo "Error al insertar: " . $e->getMessage();
      return false;
    }
  }

  /**
   * Obtener todos los caficultores registrados, ordenados por fecha de creación
   * Get all registered farmers, ordered by creation date
   *
   * @return array Lista de caficultores / List of farmers
   */
  public function getAll()
  {
    $query = "SELECT * FROM farmers ORDER BY created_at DESC";
    $stmt = $this->db->prepare($query);
    $stmt->execute();

    // Devolver todos los resultados como arreglo asociativo
    // Return all results as associative array
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
