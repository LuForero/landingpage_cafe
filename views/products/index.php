<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container my-5">
    <h2 class="mb-4">Listado de Productos</h2>

    <a href="index.php?controller=product&action=create" class="btn btn-success mb-3">
        <i class="bi bi-plus-circle"></i> Agregar Nuevo Producto
    </a>

    <a href="index.php?controller=product&action=salesHistory" class="btn btn-secondary mb-3 ms-2">
        <i class="bi bi-receipt"></i> Historial de Ventas
    </a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark text-center">
            <tr>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Descripción</th>
                <th>Stock</th>
                <th>Imagen Producto</th>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <th>Acciones</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <tr class="text-center">
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td><?= htmlspecialchars($product['category']) ?></td>
                        <td>$<?= number_format($product['price'], 0, ',', '.') ?></td>
                        <td><?= htmlspecialchars($product['description']) ?></td>
                        <td><?= $product['stock'] ?></td>
                        <td>
                            <?php if (!empty($product['image'])): ?>
                                <img src="/Landingpage-cafe/<?= htmlspecialchars($product['image']) ?>" alt="Imagen" style="width: 100px;">
                            <?php else: ?>
                                Sin imagen
                            <?php endif; ?>
                        </td>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
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
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="<?= isset($_SESSION['role']) && $_SESSION['role'] === 'admin' ? '7' : '6' ?>" class="text-center">
                        No hay productos registrados.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>