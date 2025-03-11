<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    // Si no está logrado, redirigir directamente a la página de inicio
    header("Location: http://localhost/InicioDeSesion2/index.php");
    exit;
}

// Declarar variables de sesión como vacías
$_SESSION = array();

// Destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio
header("Location: http://localhost/InicioDeSesion2/index.php");
exit;
?>
