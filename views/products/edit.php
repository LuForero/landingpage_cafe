<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container my-5">
    <h2 class="mb-4 text-center">Editar Producto</h2>

    <form action="index.php?controller=product&action=update" method="POST">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">
        <input type="hidden" name="farmer_id" value="<?= $product['farmer_id'] ?>">

        <div class="mb-3">
            <!--<label for="farmer_id" class="form-label">ID Caficultor</label>
            <input type="number" name="farmer_id" id="farmer_id" class="form-control" value="<?= $product['farmer_id'] ?>" required>-->
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Producto</label>
            <input type="text" name="name" id="name" class="form-control" value="<?= $product['name'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Categoría</label>
            <input type="text" name="category" id="category" class="form-control" value="<?= $product['category'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input type="number" step="0.01" name="price" id="price" class="form-control" value="<?= $product['price'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" name="stock" id="stock" class="form-control" value="<?= $product['stock'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" id="description" class="form-control" rows="3"><?= $product['description'] ?></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">URL de Imagen</label>
            <input type="text" name="image" id="image" class="form-control" value="<?= $product['image'] ?>">
        </div>

        <button type="submit" class="btn btn-primary w-100">Actualizar Producto</button>
    </form>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>