<?php
require_once 'models/Farmer.php';

class FarmerController {
  public function registro() {
    require 'views/registro.php';
  }

  public function guardar() {
    $farmer = new Farmer();
    $farmer->setNombre($_POST['name']);
    $farmer->setRegion($_POST['sidewalk']);
    $farmer->setCorreo($_POST['email']);
    $farmer->guardar();
    echo "<script>alert('¡Registro exitoso!');location.href='index.php';</script>";
  }
}
