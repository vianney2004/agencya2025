<?php
session_start();
include('Conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function validate($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $Usuario = validate($_POST['Usuario']);
    $Clave = validate($_POST['Clave']);

    if (empty($Usuario)) {
        header("Location: Index.php?error=El usuario es requerido");
        exit();
    } elseif (empty($Clave)) {
        header("Location: Index.php?error=La clave es requerida");
        exit();
    } else {
        $Sql = "SELECT * FROM usuarios WHERE usuario = '$Usuario' AND clave='$Clave'";
        $result = mysqli_query($conexion, $Sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['usuario'] == $Usuario && $row['clave'] == $Clave) {
                $_SESSION['Usuario'] = $row['usuario'];
                $_SESSION['Rol'] = $row['rol'];
                
                // Función para redirigir según el rol
                redirectByRole();
                exit();
            } else {
                header("Location: Index.php?error=El usuario o la clave son incorrectas");
                exit();
            }
        } else {
            header("Location: Index.php?error=No se encontró el usuario");
            exit();
        }
    }
} else {
    header("Location: Index.php");
    exit();
}
?>

<?php
function redirectByRole() {
    if ($_SESSION['Rol'] == 'administrador') {
        header("Location: inicio.php");
    } else {
        header("Location: employee.php");
    }
}
?>
