<?php
// Incluye el encabezado común del sitio (navegación, estilos, apertura de <body>, etc.)
// Include the shared site header (navigation, styles, opening <body>, etc.)
require_once __DIR__ . '/../layout/header.php';
?>


<div class="container my-5">
    <!-- Título de la página / Page title -->
    <h2 class="mb-4">Agregar Nuevo Producto</h2>

    <!-- Formulario para crear un nuevo producto /
         Form to create a new product -->
    <form action="index.php?controller=product&action=store" method="POST" enctype="multipart/form-data">

        <!-- Campo oculto para asociar el producto con el caficultor actual (sesión) /
             Hidden field to associate the product with the current logged-in farmer -->
        <input type="hidden" name="farmer_id" value="<?= htmlspecialchars($_SESSION['user_id']) ?>">

        <!-- Nombre del producto / Product name -->
        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Producto</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <!-- Categoría del producto / Product category -->
        <div class="mb-3">
            <label for="category" class="form-label">Categoría</label>
            <input type="text" class="form-control" id="category" name="category" required>
        </div>

        <!-- Precio del producto / Product price -->
        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
        </div>

        <!-- Stock disponible del producto / Available stock -->
        <div class="mb-3">
            <label for="stock" class="form-label">Stock disponible</label>
            <input type="number" class="form-control" id="stock" name="stock" required>
        </div>

        <!-- Descripción del producto / Product description -->
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>

        <!-- Imagen del producto / Product image -->
        <div class="mb-3">
            <label for="image" class="form-label">Imagen Producto</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>

        <!-- Botones de acción / Action buttons -->
        <button type="submit" class="btn btn-success">Guardar Producto</button>
        <a href="index.php?controller=product&action=index" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<?php
// Incluye el pie de página común del sitio (cierre de contenedor, scripts, cierre de body y html)
// Include the shared site footer (container closing, scripts, body and html close)
require_once __DIR__ . '/../layout/footer.php';
?>