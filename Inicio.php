<?php
session_start();
include('Conexion.php');

// Obtener el nombre del usuario
$userName = isset($_SESSION['username']) ? $_SESSION['username'] : 'Invitado';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paradise Travel - Generar Reportes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="estilo.css">
    <style>
        .text-lit {
            font-family: 'Great Vibes', cursive;
            font-size: 100px;
            color: #000000;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
    </style>
</head>
<body>
<div class="sidebar">
    <div class="logo">
        <img src="Logo.png" alt="Logo Paradise Travel" style="width: 80px;">
        <span style="font-size: 50px;">Paradise Travel</span>
    </div>
    <nav>
        <ul>
            <li><a href="#"><i class="fas fa-list"></i> Catalogos</a>
                <ul>
                 <li><a href="CRUD\Clientes.php"><i class="fas fa-user"></i> Clientes</a></li>
                    <li><a href="CRUD/Viajes.php"><i class="fas fa-plane-departure"></i> Paquetes de viajes</a></li>
                    <li><a href="CRUD/Usuarios.php"><i class="fas fa-users"></i> Usuarios</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fas fa-file-invoice-dollar"></i> Procesos</a>
                <ul>
                    <li><a href="CRUD/Reservas.php"><i class="fas fa-calendar-check"></i> Reservas</a></li>
                    <li><a href="CRUD/Pagos.php"><i class="fas fa-money-bill-wave"></i> Pagos</a></li>
                    <li><a href="CRUD/Disponibilidad.php"><i class="fas fa-check-circle"></i> Disponibilidad</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fas fa-file-pdf"></i> Generar Reportes</a>

                <ul>
                    <li><a href="/InicioDeSesion2/G_Cliente.php"><i class="fas fa-user"></i> Clientes </a></li>
                    <li><a href="/InicioDeSesion2/G_paquete.php"><i class="fas fa-plane-departure"></i> Paquetes de viajes </a></li>
                    <li><a href="/InicioDeSesion2/G_usuarios.php"><i class="fas fa-users"></i> Usuarios</a></li>
                    <li><a href="/InicioDeSesion2/G_reservas.php"><i class="fas fa-calendar-check"></i> Reservas </a></li>
                    <li><a href="/InicioDeSesion2/G_pagos.php"><i class="fas fa-money-bill-wave"></i> Pagos </a></li>
                    <li><a href="/InicioDeSesion2/G_disponibilidad.php"><i class="fas fa-check-circle"></i> Disponibilidad </a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fas fa-shield-alt"></i> Soporte Técnico</a>
                <ul>
                    <li><a href="BRMI-master/php/index.php"><i class="fas fa-database"></i> Respaldo y restauración </a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div class="footer">
        <button onclick="cerrarSesion()" class="cerrar-sesion-button"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</button>
    </div>
</div>

<div class="main-content">
    <h1 style="font-size: 100px; display: flex; justify-content: center; align-items: center;">
        <img src="Logo.png" alt="Logo Paradise Travel" style="margin-right: 20px; width: 200px;">
        
        <span class="text-lit" data-text="Paradise Travel">Paradise Travel</span>
    </h1>
    
    <div class="top-right">
    <?php 
    if (isset($_SESSION['Usuario'])) {
        echo "<span>Bienvenido, <strong>" . htmlspecialchars($_SESSION['Usuario']) . "</strong></span>";
    } else {
        echo "<span>Bienvenido, Invitado</span>";
    }
    ?>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function cerrarSesion() {
    var respuesta = confirm("¿Estás seguro de que quieres cerrar la sesión?");
    if (respuesta) {
        document.getElementById('cerrarSesionForm').submit();
    }
}
</script>

<form id="cerrarSesionForm" action="http://localhost/InicioDeSesion2/CerrarSesion.php" method="POST" style="display: none;">
    <!-- No hay contenido adicional en este formulario -->
</form>
</body>
</html>
