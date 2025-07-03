<?php
// Establece la URL base dinámica para facilitar rutas absolutas en todo el proyecto.
// Sets dynamic base URL to simplify absolute paths throughout the project.
$baseUrl = "http://" . $_SERVER['HTTP_HOST'] . "/Landingpage-cafe";
?>

<!DOCTYPE html>
<html lang="es"> <!-- Lenguaje principal del documento / Document main language -->

<head>
    <meta charset="UTF-8"> <!-- Codificación de caracteres / Character encoding -->
    <title>Bienvenido</title>

    <!-- Bootstrap CSS para estilos rápidos y responsivos /
         Bootstrap CSS for quick, responsive styling -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Íconos de Bootstrap / Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        /* Estilos generales del cuerpo / General body styles */
        body {
            background-color: #f8f5f2;
            /* Color suave de fondo / Soft background color */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            /* Fuente moderna / Modern font */
        }

        /* Estilo del logo / Logo styling */
        .logo {
            width: 300px;
            height: 100px;
            object-fit: cover;
            /* Ajuste del contenido sin deformarlo / Fit image content without distortion */
            border-radius: 0%;
            /* Sin bordes redondeados / No rounded corners */
        }

        /* Posición del botón de cerrar sesión / Logout button position */
        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
        }
    </style>
</head>

<body>

    <!-- Botón Cerrar Sesión / Logout Button -->
    <div class="logout-btn">
        <a href="<?= $baseUrl ?>/public/index.php?controller=auth&action=logout" class="btn btn-danger">
            <i class="bi bi-box-arrow-right"></i>Cerrar sesión
        </a>
    </div>

    <!-- Contenido principal / Main content -->
    <div class="container text-center mt-5">
        <!-- Logo de la aplicación / Application logo -->
        <img src="<?= $baseUrl ?>/public/img/logo-cafemontañero.png" alt="Logo" class="logo mb-4">