<?php
$baseUrl = "http://" . $_SERVER['HTTP_HOST'] . "/Landingpage-cafe";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f5f2;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .logo {
            width: 300px;
            height: 100px;
            object-fit: cover;
            border-radius: 0%;
        }

        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
        }
    </style>
</head>

<body>

    <!-- Botón Cerrar Sesión -->
    <div class="logout-btn">
        <a href="<?= $baseUrl ?>/public/index.php?controller=auth&action=logout" class="btn btn-danger">
            <i class="bi bi-box-arrow-right"></i> Cerrar sesión
        </a>
    </div>

    <!-- Contenido principal -->
    <div class="container text-center mt-5">
        <img src="<?= $baseUrl ?>/public/img/logo-cafemontañero.png" alt="Logo" class="logo mb-4">