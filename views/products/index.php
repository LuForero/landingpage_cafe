<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container my-5">
    <h2 class="mb-4">Listado de Productos</h2>

    <a href="index.php?controller=product&action=create" class="btn btn-success mb-3">
        <i class="bi bi-plus-circle"></i> Agregar Nuevo Producto
    </a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark text-center">
            <tr>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <tr class="text-center">
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td><?= htmlspecialchars($product['category']) ?></td>
                        <td>$<?= number_format($product['price'], 0, ',', '.') ?></td>
                        <td><?= $product['stock'] ?></td>
                        <td>
                            <?php if (!empty($product['image'])): ?>
                                <img src="<?= $product['image'] ?>" alt="Imagen producto" width="60" height="60">
                            <?php else: ?>
                                Sin imagen
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="index.php?controller=product&action=edit&id=<?= $product['id'] ?>" class="btn btn-warning btn-sm">
                                Editar
                            </a>
                            <a href="index.php?controller=product&action=delete&id=<?= $product['id'] ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Estás seguro de eliminar este producto?');">
                                Eliminar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">No hay productos registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>