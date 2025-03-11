<?php
sleep(1);
include('config.php');

// Función para obtener la fecha formateada
function getFormatedDate($dateString) {
    return date("Y-m-d", strtotime($dateString));
}

// Obtenemos las fechas desde el formulario o usamos fechas dummy si no se envían
$fechaInit = isset($_POST['f_inicio']) ? getFormatedDate($_POST['f_inicio']) : '2023-01-01';
$fechaFin  = isset($_POST['f_fin']) ? getFormatedDate($_POST['f_fin']) : '2023-12-31';

// Preparamos la consulta SQL
$sqlPaquetes = "SELECT * FROM paquetes_viaje 
                 WHERE fecha_inicio BETWEEN '$fechaInit' AND '$fechaFin'
                 ORDER BY fecha_inicio ASC";

// Ejecutamos la consulta
$query = mysqli_query($con, $sqlPaquetes);

// Contamos el número total de resultados
$total = mysqli_num_rows($query);

// Mostramos el total
echo '<strong>Total de paquetes: </strong> (' . $total . ')';

// Comenzamos a construir el HTML de la tabla
?>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">ID PAQUETE</th>
            <th scope="col">NOMBRE</th>
            <th scope="col">DESCRIPCIÓN</th>
            <th scope="col">PRECIO</th>
            <th scope="col">DURACIÓN</th>
            <th scope="col">FECHA DE INICIO</th>
            <th scope="col">FECHA DE FIN</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Iteramos sobre los resultados de la consulta
        while ($dataRow = mysqli_fetch_array($query)) {
            ?>
            <tr>
                <td><?php echo $dataRow['id_paquete']; ?></td>
                <td><?php echo $dataRow['nombre']; ?></td>
                <td><?php echo $dataRow['descripción']; ?></td>
                <td><?php echo $dataRow['precio']; ?></td>
                <td><?php echo $dataRow['duración']; ?></td>
                <td><?php echo $dataRow['fecha_inicio']; ?></td>
                <td><?php echo $dataRow['fecha_fin']; ?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
