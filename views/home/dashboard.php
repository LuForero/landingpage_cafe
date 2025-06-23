<?php require_once __DIR__ . '/../layout/header_dashboard.php'; ?>
<?php if (!isset($_SESSION)) session_start(); ?>

<div class="container mt-5">
    <h2 class="mb-4 text-center">¡Bienvenido(a), <?= htmlspecialchars($_SESSION['name']) ?>!</h2>
    <p class="text-center">Selecciona una sección para continuar:</p>

    <div class="row justify-content-center">
        <!-- Caficultores -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100 text-center">
                <div class="card-body">
                    <i class="bi bi-people-fill display-4 text-primary mb-3"></i>
                    <h5 class="card-title">Caficultores</h5>
                    <p class="card-text">Gestión y listado de caficultores registrados.</p>
                    <a href="/Landingpage-cafe/public/index.php?controller=farmer&action=listar" class="btn btn-outline-primary">Ver Caficultores</a>
                </div>
            </div>
        </div>

        <!-- Productos -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100 text-center">
                <div class="card-body">
                    <i class="bi bi-cup-hot-fill display-4 text-success mb-3"></i>
                    <h5 class="card-title">Productos</h5>
                    <p class="card-text">Visualiza los productos del café disponibles.</p>
                    <a href="/Landingpage-cafe/public/index.php?controller=product&action=index" class="btn btn-outline-success">Ver Productos</a>
                </div>
            </div>
        </div>

        <?php if ($_SESSION['role'] === 'admin'): ?>
            <!-- Usuarios -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 h-100 text-center">
                    <div class="card-body">
                        <i class="bi bi-person-lines-fill display-4 text-dark mb-3"></i>
                        <h5 class="card-title">Usuarios</h5>
                        <p class="card-text">Administración de usuarios del sistema.</p>
                        <a href="/Landingpage-cafe/public/index.php?controller=user&action=index" class="btn btn-outline-dark">Ver Usuarios</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer_dashboard.php'; ?>