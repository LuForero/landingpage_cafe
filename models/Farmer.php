<?php

class Farmer
{
  private $db;

  public function __construct($conexion)
  {
    $this->db = $conexion;
  }

  public function registrar($name, $location_type, $sidewalk, $email, $phone, $description)
  {
    try {
      $stmt = $this->db->prepare("INSERT INTO farmers (name, location_type, sidewalk, email, phone, description) 
                                   VALUES (:name, :location_type, :sidewalk, :email, :phone, :description)");

      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':location_type', $location_type);
      $stmt->bindParam(':sidewalk', $sidewalk);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':phone', $phone);
      $stmt->bindParam(':description', $description);

      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      // MOSTRAMOS EL ERROR PARA SABER QUÉ FALLA
      echo "Error al insertar: " . $e->getMessage();
      return false;
    }
  }
}
