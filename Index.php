<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqy12QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="Style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Inicio de Sesión</title>
</head>
<body>
    <form action="IniciarSesion.php" method="POST">
        <h1>INICIAR SESION</h1>
        <hr>
        <?php
            if (isset($_GET['error'])) {
                ?>
                <p class ="error">
                   <?php
                   echo $_GET['error']
                   ?>
                </p>
            <?php
            }
            ?>


        <hr>

        <i class="fa-solid fa-user"></i>
        <label>Usuario</label>
        <input type="text" name="Usuario" placeholder="Nombre de usuario">

        <i class="fa-solid fa-unlock"></i>
        <label>Clave</label>
        <input type="password" name="Clave" placeholder="Clave">

        <hr>

        <button type="submit">Iniciar sesión</button>
        <a href="CrearCuenta.php">Crear cuenta</a>


    </form>
        

   
    
</body>
</html>