<?php
sleep(1);
include('config.php');

// Función para obtener la fecha formateada
function getFormatedDate($dateString) {
    return date("Y-m-d", strtotime($dateString));
}

// Obtenemos las fechas desde el formulario o usamos fechas dummy si no se envían
$fechaInit = isset($_POST['f_fecha']) ? getFormatedDate($_POST['f_fecha']) : '2023-01-01';
$fechaFin  = isset($_POST['f_fin']) ? getFormatedDate($_POST['f_fin']) : '2023-12-31';

// Comprobación de que ambas fechas estén definidas
if (empty($fechaInit) || empty($fechaFin)) {
    echo '<div class="alert alert-danger">Por favor, ingrese una fecha de inicio y fin.</div>';
} else {
    // Preparamos la consulta SQL
    $sqlDisponibilidad = "SELECT id_disponibilidad, fecha, nombre_paquete, total_asientos, asientos_reservados, asientos_disponibles, id_reserva
    FROM disponibilidad
    WHERE fecha BETWEEN '$fechaInit' AND '$fechaFin'
    ORDER BY fecha ASC";

    // Ejecutamos la consulta
    $query = mysqli_query($con, $sqlDisponibilidad);

    if (!$query) {
        echo '<div class="alert alert-danger">Error al ejecutar la consulta: ' . mysqli_error($con) . '</div>';
    } else {
        // Contamos el número total de resultados
        $total = mysqli_num_rows($query);

        // Mostramos el total
        echo '<strong>Total de disponibilidades: </strong> (' . $total . ')';

        // Comenzamos a construir el HTML de la tabla
        ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID DISPONIBILIDAD</th>
                    <th scope="col">FECHA</th>
                    <th scope="col">NOMBRE PAQUETE</th>
                    <th scope="col">TOTAL ASIENTOS</th>
                    <th scope="col">ASIENTOS RESERVADOS</th>
                    <th scope="col">ASIENTOS DISPONIBLES</th>
                    <th scope="col">ID RESERVA</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Iteramos sobre los resultados de la consulta
                while ($dataRow = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td><?php echo $dataRow['id_disponibilidad']; ?></td>
                        <td><?php echo $dataRow['fecha']; ?></td>
                        <td><?php echo $dataRow['nombre_paquete']; ?></td>
                        <td><?php echo $dataRow['total_asientos']; ?></td>
                        <td><?php echo $dataRow['asientos_reservados']; ?></td>
                        <td><?php echo $dataRow['asientos_disponibles']; ?></td>
                        <td><?php echo $dataRow['id_reserva']; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    }
}
?>

<?php
// Liberar recursos de MySQL
mysqli_close($con);
?>
