<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container my-5">
    <h2 class="mb-4">Agregar Nuevo Producto</h2>

    <form action="index.php?controller=product&action=store" method="POST">

        <!-- farmer_id oculto -->
        <input type="hidden" name="farmer_id" value="<?= htmlspecialchars($_SESSION['user_id']) ?>">

        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Producto</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Categoría</label>
            <input type="text" class="form-control" id="category" name="category" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock disponible</label>
            <input type="number" class="form-control" id="stock" name="stock" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">URL de la Imagen</label>
            <input type="text" class="form-control" id="image" name="image">
        </div>

        <button type="submit" class="btn btn-success">Guardar Producto</button>
        <a href="index.php?controller=product&action=index" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>