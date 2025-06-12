<head>
  <meta charset="UTF-8">
  <title>Registro de Caficultor</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

  <div class="container mt-5">
    <h2 class="mb-4">Registro de Caficultor</h2>

    <form action="../public/index.php?action=registrar" method="POST" class="bg-white p-4 rounded shadow">
      <div class="mb-3">
        <label for="name" class="form-label">Nombre completo</label>
        <input type="text" name="name" id="name" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="sidewalk" class="form-label">Vereda</label>
        <input type="text" name="sidewalk" id="sidewalk" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Correo electrónico</label>
        <input type="email" name="email" id="email" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="phone" class="form-label">Teléfono</label>
        <input type="text" name="phone" id="phone" class="form-control">
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Descripción</label>
        <textarea name="description" id="description" class="form-control"></textarea>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" name="password" id="password" class="form-control" required>
      </div>

      <button action= "../public/index.php?action=registroExitoso"type="submit" class="btn btn-success">Registrarse</button>
    </form>
  </div>

</body>

</html>