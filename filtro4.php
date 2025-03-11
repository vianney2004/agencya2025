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

// Preparamos la consulta SQL
$sqlReservas = "SELECT id_reserva, fecha_reserva, cantidad_personas, total_pagado, 
                cliente_nombre, paquete_nombre
                FROM reservas
                WHERE fecha_reserva BETWEEN '$fechaInit' AND '$fechaFin'
                ORDER BY fecha_reserva ASC";

// Ejecutamos la consulta
$query = mysqli_query($con, $sqlReservas);

// Contamos el número total de resultados
$total = mysqli_num_rows($query);

// Mostramos el total
echo '<strong>Total de reservas: </strong> (' . $total . ')';

// Comenzamos a construir el HTML de la tabla
?>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">ID RESERVA</th>
            <th scope="col">FECHA DE RESERVA</th>
            <th scope="col">CANTIDAD DE PERSONAS</th>
            <th scope="col">TOTAL PAGADO</th>
            <th scope="col">CLIENTE</th>
            <th scope="col">PAQUETE</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
        // Iteramos sobre los resultados de la consulta
        while ($dataRow = mysqli_fetch_array($query)) {
            ?>
            <tr>
                <td><?php echo $dataRow['id_reserva']; ?></td>
                <td><?php echo $dataRow['fecha_reserva']; ?></td>
                <td><?php echo $dataRow['cantidad_personas']; ?></td>
                <td><?php echo $dataRow['total_pagado']; ?></td>
                <td><?php echo $dataRow['cliente_nombre']; ?></td>
                <td><?php echo $dataRow['paquete_nombre']; ?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
