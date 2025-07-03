<?php
// Incluye el encabezado común (barra de navegación, estilos, etc.)
// Include the shared header (navbar, styles, etc.)
require_once __DIR__ . '/../layout/header.php';
?>


<div class="container my-5">
    <!-- Título centrado / Centered title -->
    <h2 class="mb-4 text-center">Editar Producto</h2>

    <!-- Formulario para actualizar el producto /
         Form to update the product -->
    <form action="index.php?controller=product&action=update" method="POST" enctype="multipart/form-data">

        <!-- Campo oculto con el ID del producto /
             Hidden field with product ID -->
        <input type="hidden" name="id" value="<?= $product['id'] ?>">

        <!-- ID del caficultor (comentado) /
             Farmer ID (commented out) -->
        <div class="mb-3">
            <!--
            <label for="farmer_id" class="form-label">ID Caficultor / Farmer ID</label>
            <input type="number" name="farmer_id" id="farmer_id" class="form-control" value="<?= $product['farmer_id'] ?>" required>
            -->
        </div>

        <!-- Nombre del producto / Product Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Producto</label>
            <input type="text" name="name" id="name" class="form-control" value="<?= $product['name'] ?>" required>
        </div>

        <!-- Categoría del producto / Product Category -->
        <div class="mb-3">
            <label for="category" class="form-label">Categoría</label>
            <input type="text" name="category" id="category" class="form-control" value="<?= $product['category'] ?>" required>
        </div>

        <!-- Precio del producto / Product Price -->
        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input type="number" step="0.01" name="price" id="price" class="form-control" value="<?= $product['price'] ?>" required>
        </div>

        <!-- Stock disponible / Available Stock -->
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" name="stock" id="stock" class="form-control" value="<?= $product['stock'] ?>" required>
        </div>

        <!-- Descripción del producto / Product Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" id="description" class="form-control" rows="3"><?= $product['description'] ?></textarea>
        </div>

        <!-- Imagen del producto / Product Image -->
        <div class="mb-3">
            <label for="image" class="form-label">Imagen Producto</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
        </div>

        <!-- Botón para enviar el formulario / Submit button -->
        <button type="submit" class="btn btn-primary w-100">Actualizar Producto</button>
    </form>
</div>
<?php
// Incluye el pie de página común (scripts, cierre de contenedor y de HTML)
// Include the shared footer (scripts, container and HTML closing)
require_once __DIR__ . '/../layout/footer.php';
?>