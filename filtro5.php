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
$sqlPagos = "SELECT id_pago, fecha_pago, monto_pagado, metodo_pago, reserva_nombre
            FROM pagos
            WHERE fecha_pago BETWEEN '$fechaInit' AND '$fechaFin'
            ORDER BY fecha_pago ASC";

// Ejecutamos la consulta
$query = mysqli_query($con, $sqlPagos);

// Contamos el número total de resultados
$total = mysqli_num_rows($query);

// Mostramos el total
echo '<strong>Total de pagos: </strong> (' . $total . ')';

// Comenzamos a construir el HTML de la tabla
?>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">ID PAGO</th>
            <th scope="col">RESERVA NOMBRE</th>
            <th scope="col">FECHA DE PAGO</th>
            <th scope="col">MONTO PAGADO</th>
            <th scope="col">METODO DE PAGO</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Iteramos sobre los resultados de la consulta
        while ($dataRow = mysqli_fetch_array($query)) {
            ?>
            <tr>
                <td><?php echo $dataRow['id_pago']; ?></td>
                <td><?php echo $dataRow['reserva_nombre']; ?></td>
                <td><?php echo $dataRow['fecha_pago']; ?></td>
                <td><?php echo $dataRow['monto_pagado']; ?></td>
                <td><?php echo $dataRow['metodo_pago']; ?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
