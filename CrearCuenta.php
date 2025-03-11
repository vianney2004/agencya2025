<?php
session_start();
include('Conexion.php');

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesar el formulario de registro
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    $rol = $_POST['rol'];

    // Validar los campos
    if (empty($usuario) || empty($clave) || empty($rol)) {
        $error = "Por favor, complete todos los campos.";
    } else {
        // Preparar la consulta SQL
        $sql = "INSERT INTO usuario (Usuario, Clave, Rol) VALUES (?, ?, ?)";

        // Preparar la sentencia SQL
        $stmt = mysqli_prepare($conexion, $sql);

        // Enlazar los parámetros
        mysqli_stmt_bind_param($stmt, "sss", $usuario, $clave, $rol);

        // Ejecutar la consulta
        if (mysqli_stmt_execute($stmt)) {
            $success = "Cuenta creada con éxito!";
        } else {
            $error = "Falló al crear la cuenta. Por favor, inténtelo nuevamente.";
        }

        // Liberar recursos
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqy12QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="Style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqydsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Crear Cuenta</title>
</head>
<body>
    <form action="" method="POST">
        <h1>CREAR CUENTA</h1>
        <hr>
        <?php
            if (!empty($error)) {
                ?>
                <p class="error">
                   <?php
                   echo $error;
                   ?>
                </p>
            <?php
            }
            if (!empty($success)) {
                ?>
                <p class="success">
                   <?php
                   echo $success;
                   ?>
                </p>
            <?php
            }
            ?>

        <hr>

        <i class="fa-solid fa-user"></i>
        <label>Usuario</label>
        <input type="text" name="usuario" placeholder="Nombre de usuario" required>

        <i class="fa-solid fa-lock"></i>
        <label>Clave</label>
        <input type="password" name="clave" placeholder="Clave" required>

        <i class="fa-solid fa-star"></i>
        <label>Rol</label>
        <select name="rol" required>
            <option value="">Seleccione un rol</option>
            <option value="admin">Administrador</option>
            <option value="cliente">Empleado</option>
            
        </select>

        <hr>

        <button type="submit">Crear cuenta</button>
        <a href="IniciarSesion.php">Volver al inicio</a>
    </form>
</body>
</html>
