<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Registro de Caficultor</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

  <style>
    body {
      background-image: url('../public/img/img-fondo-formulario.jpg');
      /* Cambia esta ruta a tu imagen */
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .form-container {
      background-color: rgba(255, 255, 255, 0.95);
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.28);
      max-width: 600px;
      width: 100%;
    }
  </style>
</head>

<body>

  <div class="form-container">
    <h2 class="text-center mb-4">Registro de Caficultor</h2>

    <form action="index.php?controller=farmer&action=registrar" method="POST">
      <div class="mb-3">
        <label for="name" class="form-label">Nombre y Apellido</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Ingresa tu nombre completo" required>
      </div>

      <div class="mb-3">
        <label for="location_type" class="form-label">Tipo de ubicación</label>
        <select name="location_type" id="location_type" class="form-select" required>
          <option value="">Seleccione</option>
          <option value="Vereda">Vereda</option>
          <option value="Municipio">Municipio</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="sidewalk" class="form-label">Nombre de la vereda o municipio</label>
        <input type="text" name="sidewalk" id="sidewalk" class="form-control" placeholder="Ejemplo: El Paraíso" required>
      </div>


      <div class="mb-3">
        <label for="email" class="form-label">Correo electrónico (opcional)</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="ejemplo@correo.com">
      </div>

      <div class="mb-3">
        <label for="phone" class="form-label">Teléfono</label>
        <input type="text" name="phone" id="phone" class="form-control" placeholder="Número de contacto" required>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Descripción</label>
        <textarea name="description" id="description" class="form-control" placeholder="Cuéntanos sobre tu finca, cultivo, experiencia..." required></textarea>
      </div>

      <!-- <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Crea una contraseña segura" required>
      </div>-->

      <div class="d-flex justify-content-between gap-3">
        <button type="submit" class="btn btn-lg w-50" style="background-color: #4E7316; color: white;">Registrarse</button>
        <a href="/Landingpage-cafe/public/" class="btn btn-outline btn-lg w-50" style="background-color: #262526; color: white;">Volver al inicio</a>
      </div>

    </form>
  </div>

</body>

</html>