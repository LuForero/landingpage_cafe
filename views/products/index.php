<?php
// Incluye el encabezado general (barra de navegación, estilos, etc.)
// Include the shared header (navbar, styles, etc.)
require_once __DIR__ . '/../layout/header.php';
?>


<div class="container my-5">
    <!-- Título de la sección / Section title -->
    <h2 class="mb-4">Listado de Productos</h2>

    <!-- Botón para agregar un nuevo producto / Add new product button -->
    <a href="index.php?controller=product&action=create" class="btn mb-3" style="background-color: #4E7316; color: white;">
        <i class="bi bi-plus-circle"></i> Agregar Nuevo Producto
    </a>

    <!-- Botón para ir al historial de ventas / Sales history button -->
    <a href="index.php?controller=product&action=salesHistory" class="btn mb-3 ms-2" style="background-color: #262526; color: white;">
        <i class="bi bi-receipt"></i> Historial de Ventas
    </a>

    <!-- Tabla con los productos registrados / Table with registered products -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr class="text-center">
                <th style="background-color: #59463F; color: white;">Nombre</th>
                <th style="background-color: #59463F; color: white;">Categoría</th>
                <th style="background-color: #59463F; color: white;">Precio</th>
                <th style="background-color: #59463F; color: white;">Descripción</th>
                <th style="background-color: #59463F; color: white;">Stock</th>
                <th style="background-color: #59463F; color: white;">Imagen Producto</th>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <th style="background-color: #59463F; color: white;">Acciones</th>
                <?php endif; ?>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <tr class="text-center">
                        <!-- Mostrar datos del producto / Display product data -->
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td><?= htmlspecialchars($product['category']) ?></td>
                        <td>$<?= number_format($product['price'], 0, ',', '.') ?></td>
                        <td><?= htmlspecialchars($product['description']) ?></td>
                        <td><?= htmlspecialchars($product['stock']) ?></td>

                        <td>
                            <?php if (!empty($product['image'])): ?>
                                <img src="/Landingpage-cafe/<?= htmlspecialchars($product['image']) ?>" alt="Imagen" style="width: 100px;">
                            <?php else: ?>
                                Sin imagen
                            <?php endif; ?>
                        </td>

                        <!-- Mostrar acciones solo si es administrador /
                             Show actions only if user is admin -->
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                            <td>
                                <!-- Botón editar / Edit button -->
                                <a href="index.php?controller=product&action=edit&id=<?= $product['id'] ?>" class="btn btn-sm" style="background-color: #4E7316; color: white;">Editar</a>

                                <!-- Botón eliminar / Delete button -->
                                <a href="index.php?controller=product&action=delete&id=<?= $product['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este producto? / Are you sure you want to delete this product?');">Eliminar</a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Mensaje si no hay productos registrados /
                     Message if there are no registered products -->
                <tr>
                    <td colspan="<?= isset($_SESSION['role']) && $_SESSION['role'] === 'admin' ? '7' : '6' ?>" class="text-center">
                        No hay productos registrados.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php
// Incluye el pie de página general (scripts y cierre del documento HTML)
// Include the shared footer (scripts and HTML closing)
require_once __DIR__ . '/../layout/footer.php';
?>