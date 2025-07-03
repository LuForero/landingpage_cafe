<?php
// Calculamos el path absoluto dinámico para rutas consistentes en todo el proyecto.
// Calculate the dynamic absolute path for consistent routing across the project.
$baseUrl = "http://" . $_SERVER['HTTP_HOST'] . "/Landingpage-cafe";
?>

<!DOCTYPE html>
<html lang="es"> <!-- Idioma principal: español / Main language: Spanish -->

<head>
    <meta charset="UTF-8"> <!-- Codificación de caracteres / Character encoding -->
    <title>Café Montañero</title> <!-- Título de la pestaña del navegador / Browser tab title -->

    <!-- Bootstrap CSS para estilos rápidos y responsive /
         Bootstrap CSS for quick and responsive design -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Íconos de Bootstrap / Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        /* Estilo base del cuerpo / Base body styling */
        body {
            background-color: #f8f5f2;
            /* Color suave de fondo / Soft background color */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            /* Fuente legible / Readable font */
        }

        /* Color de fondo de la barra de navegación / Navbar background color */
        .navbar {
            background-color: #F2DAC4;
        }

        /* Estilo del logo / Logo styling */
        .navbar-brand img {
            width: 180px;
            height: 70px;
            border-radius: 50%;
            /* Logo circular / Circular logo */
        }
    </style>
</head>

<body>

    <!-- Estructura para mantener el footer en la parte inferior /
         Structure to keep the footer at the bottom -->
    <div class="d-flex flex-column min-vh-100">

        <!-- Barra de navegación superior / Top navigation bar -->
        <nav class="navbar navbar-expand-lg shadow-sm">
            <div class="container">

                <!-- Logo que redirige al inicio / Logo linking to homepage -->
                <a class="navbar-brand" href="http://localhost:8888/Landingpage-cafe/public/">
                    <img src="<?= $baseUrl ?>/public/img/logo-cafemontañero.png" alt="Logo Café" class="d-inline-block align-text-top">
                </a>

                <!-- Botón de menú móvil / Mobile menu button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCafe" aria-controls="navbarCafe" aria-expanded="false" aria-label="Menú">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Elementos del menú / Menu items -->
                <div class="collapse navbar-collapse" id="navbarCafe">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                        <!-- Verifica si hay sesión iniciada / Check if user session is active -->
                        <?php if (isset($_SESSION['role'])): ?>

                            <!-- Saludo personalizado / Personalized greeting -->
                            <li class="nav-item">
                                <span class="nav-link">Bienvenido(a), <?= htmlspecialchars($_SESSION['name']) ?></span>
                            </li>

                            <!-- Opciones visibles para admin y editor / Options visible to admin and editor -->
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?controller=farmer&action=listar">Ver Caficultores</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="index.php?controller=product&action=index">Productos</a>
                            </li>

                            <!-- Solo el administrador puede ver usuarios / Only admin can view users -->
                            <?php if ($_SESSION['role'] === 'admin'): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?controller=user&action=index">Usuarios</a>
                                </li>
                            <?php endif; ?>

                            <!-- Opción para cerrar sesión / Logout option -->
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?controller=auth&action=logout">Cerrar sesión</a>
                            </li>

                        <?php else: ?>
                            <!-- Si no hay sesión, muestra opción para iniciar / If not logged in, show login option -->
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?controller=auth&action=login">Iniciar Sesión</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

            </div>
        </nav>

        <!-- Contenedor principal de contenido / Main content container -->
        <div class="container mt-4">