<?php
// Calculamos el path absoluto dinámico
$baseUrl = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
$baseUrl = rtrim($baseUrl, "/\\");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Café Montañero</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #f8f5f2;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background-color: #F2DAC4;
        }

        .navbar-brand img {
            width: 180px;
            height: 70px;
            border-radius: 50%;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="http://localhost:8888/Landingpage-cafe/public/">
                <img src="../public/img/logo-cafemontañero.png" alt="Logo Café" class="d-inline-block align-text-top"></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCafe" aria-controls="navbarCafe" aria-expanded="false" aria-label="Menú">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCafe">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php if (isset($_SESSION['role'])): ?>
                        <li class="nav-item">
                            <span class="nav-link">Bienvenido(a), <?= htmlspecialchars($_SESSION['name']) ?></span>
                        </li>

                        <?php if ($_SESSION['role'] === 'admin'): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?controller=farmer&action=listar">Ver Caficultores</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?controller=product&action=index">Productos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?controller=user&action=index">Usuarios</a>
                            </li>
                        <?php endif; ?>

                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=auth&action=logout">Cerrar sesión</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=auth&action=login">Iniciar Sesión</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">