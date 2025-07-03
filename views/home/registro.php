<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Registro de Caficultor</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

  <style>
    /* Fondo con imagen para el formulario / Background image for the form */
    body {
      background-image: url('../public/img/img-fondo-formulario.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    /* Contenedor del formulario con diseño estético / Styled form container */
    .form-container {
      background-color: rgba(255, 255, 255, 0.95);
      /* Fondo blanco semitransparente / White semi-transparent background */
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.28);
      /* Sombra / Shadow */
      max-width: 600px;
      width: 100%;
    }
  </style>
</head>

<body>

  <div class="form-container">
    <!-- Título principal / Main title -->
    <h2 class="text-center mb-4">Registro de Caficultor</h2>

    <!-- Formulario que envía datos al controlador FarmerController / Form that sends data to the FarmerController -->
    <form action="index.php?controller=farmer&action=registrar" method="POST">

      <!-- Campo: Nombre / Name -->
      <div class="mb-3">
        <label for="name" class="form-label">Nombre y Apellido</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Ingresa tu nombre completo" required>
      </div>

      <!-- Campo: Tipo de ubicación / Location type -->
      <div class="mb-3">
        <label for="location_type" class="form-label">Tipo de ubicación</label>
        <select name="location_type" id="location_type" class="form-select" required>
          <option value="">Seleccione</option>
          <option value="Vereda">Vereda</option>
          <option value="Municipio">Municipio</option>
        </select>
      </div>

      <!-- Campo: Vereda o Municipio / Town or Rural Area Name -->
      <div class="mb-3">
        <label for="sidewalk" class="form-label">Nombre de la vereda o municipio</label>
        <input type="text" name="sidewalk" id="sidewalk" class="form-control" placeholder="Ejemplo: El Paraíso" required>
      </div>

      <!-- Campo: Correo electrónico / Email -->
      <div class="mb-3">
        <label for="email" class="form-label">Correo electrónico (opcional)</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="Email">
      </div>

      <!-- Campo: Teléfono / Phone -->
      <div class="mb-3">
        <label for="phone" class="form-label">Teléfono</label>
        <input type="text" name="phone" id="phone" class="form-control" placeholder="Número de contacto" required>
      </div>

      <!-- Campo: Descripción / Description -->
      <div class="mb-3">
        <label for="description" class="form-label">Descripción</label>
        <textarea name="description" id="description" class="form-control" placeholder="Cuéntanos sobre tu finca, cultivo, experiencia..." required></textarea>
      </div>

      <!-- Botones de acción: enviar y volver / Submit and back buttons -->
      <div class="d-flex justify-content-between gap-3">
        <button type="submit" class="btn btn-lg w-50" style="background-color: #4E7316; color: white;">Registrarse</button>
        <a href="/Landingpage-cafe/public/" class="btn btn-outline btn-lg w-50" style="background-color: #262526; color: white;">Volver al inicio</a>
      </div>
    </form>
  </div>

</body>

</html>