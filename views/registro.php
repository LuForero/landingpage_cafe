<div class="container mt-5">
  <h2>Registro de Caficultores</h2>
  <form method="POST" action="index.php?action=guardar">
    <div class="mb-3">
      <label>Nombre</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Vereda</label>
      <input type="text" name="sidewalk" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Correo</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
  </form>
</div>
