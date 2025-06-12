<?php

class Farmer
{
  private $db;

  public function __construct($conexion)
  {
    $this->db = $conexion;
  }

  public function registrar($name, $sidewalk, $email, $phone, $description, $password)
  {
    try {
      $stmt = $this->db->prepare("INSERT INTO farmers (name, sidewalk, email, phone, description, password) 
                                   VALUES (:name, :sidewalk, :email, :phone, :description, :password)");

      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':sidewalk', $sidewalk);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':phone', $phone);
      $stmt->bindParam(':description', $description);
      $stmt->bindParam(':password', $password);

      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      return false;
    }
  }
}
