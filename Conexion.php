<?php
     
     $host = "localhost";
     $User = "root";
     $pass = "";

     $db = "agenciaviajes2";

     $conexion = mysqli_connect($host, $User, $pass, $db);

     if (!$conexion) {
        die("Error de conexión: " . mysqli_error());
     }
?>
