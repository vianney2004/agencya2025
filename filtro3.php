<?php
sleep(1);
include('config.php');

// Función para obtener la fecha formateada
function getFormatedDate($dateString) {
    return date("Y-m-d", strtotime($dateString));
}

// Obtenemos las fechas desde el formulario o usamos fechas dummy si no se envían
$fechaInit = isset($_POST['f_ingreso']) ? getFormatedDate($_POST['f_ingreso']) : '2023-01-01';
$fechaFin  = isset($_POST['f_fin']) ? getFormatedDate($_POST['f_fin']) : '2023-12-31';

// Preparamos la consulta SQL
$sqlUsuarios = "SELECT * FROM usuarios 
                 WHERE fecha_ingreso BETWEEN '$fechaInit' AND '$fechaFin'
                 ORDER BY fecha_ingreso ASC";

// Ejecutamos la consulta
$query = mysqli_query($con, $sqlUsuarios);

// Contamos el número total de resultados
$total = mysqli_num_rows($query);

// Mostramos el total
echo '<strong>Total de usuarios: </strong> (' . $total . ')';

// Comenzamos a construir el HTML de la tabla
?>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">ID USUARIO</th>
            <th scope="col">USUARIO</th>
            <th scope="col">CLAVE</th>
            <th scope="col">ROL</th>
            <th scope="col">FECHA DE INGRESO</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Iteramos sobre los resultados de la consulta
        while ($dataRow = mysqli_fetch_array($query)) {
            ?>
            <tr>
                <td><?php echo $dataRow['id_usuario']; ?></td>
                <td><?php echo $dataRow['usuario']; ?></td>
                <td><?php echo $dataRow['clave']; ?></td>
                <td><?php echo $dataRow['rol']; ?></td>
                <td><?php echo $dataRow['fecha_ingreso']; ?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
