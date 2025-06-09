<?php
require_once 'config/db.php';

class Farmer {
  private $name, $sidewalk, $email;

  public function setNombre($n) { $this->name = $n; }
  public function setRegion($r) { $this->sidewalk = $r; }
  public function setCorreo($c) { $this->email = $c; }

  public function guardar() {
    global $db;
    $sql = "INSERT INTO farmers (nombre, region, correo)
            VALUES ('$this->name', '$this->sidewalk', '$this->email')";
    $db->query($sql);
  }
}
