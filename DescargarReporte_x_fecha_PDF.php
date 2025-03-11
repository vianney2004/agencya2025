<?php
require_once('tcpdf/tcpdf.php');
require_once('config.php');
date_default_timezone_set('America/Mexico City');

ob_end_clean();

class MYPDF extends TCPDF {
    public function Header() {
        $bMargin = $this->getBreakMargin();
        $auto_page_break = $this->AutoPageBreak;
        $this->SetAutoPageBreak(false, 0);
        $img_file = dirname(__FILE__) . '/InicioDeSesion2/LOGO.jpg';
        $this->Image($img_file, 85, 8, 20, 25, '', '', '', false, 30, '', false, false, 0);
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        $this->setPageMark();
    }
}

// Iniciando un nuevo PDF
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, 'mm', 'Letter', true, 'UTF-8', false);

// Establecer margenes del PDF
$pdf->SetMargins(20, 35, 25);
$pdf->SetHeaderMargin(20);
$pdf->setPrintFooter(false);
$pdf->setPrintHeader(true);

// Información del PDF
$pdf->SetTitle('Informe de Clientes');

// Agregando la primera página
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 10); // Tipo de fuente y tamaño de letra

// Encabezado
$totalWidth = 40 + 60 + 50 + 50 + 80 + 70; // Suma de anchos de todas las celdas
$cellHeight = 6;
$cellWidth = $pdf->getTemplateSize()['w'] / ($totalWidth / 6); // Ajusta el ancho de cada celda

$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('helvetica', 'B', 9);
for ($i = 0; $i < 6; $i++) {
    $pdf->Cell($cellWidth, $cellHeight, 'ENCABEZADO', 1, 0, 'C', true);
}

// Código para obtener fechas desde inputs
$fechaInit = date("Y-m-d", strtotime($_POST['fecha_ingreso']));
$fechaFin = date("Y-m-d", strtotime($_POST['fechaFin']));

// SQL para consultar clientes
$sqlClientes = "SELECT * FROM clientes WHERE fecha_ingreso BETWEEN '$fechaInit' AND '$fechaFin' ORDER BY fecha_ingreso ASC";
$query = mysqli_query($con, $sqlClientes);

// Verificar si la consulta tuvo éxito
if (!$query) {
    $pdf->Error('Error al ejecutar la consulta SQL', 'Error en la línea ' . mysqli_error($con));
} else {
    // Mostrar datos en la tabla
    $currentRow = 0;
    while ($dataRow = mysqli_fetch_array($query)) {
        try {
            // Manejo de errores para cada celda
            $pdf->Cell($cellWidth, $cellHeight, isset($dataRow['id_cliente']) ? $dataRow['id_cliente'] : '', 1, 0, 'C');
            
            if (strlen(isset($dataRow['nombre']) ? $dataRow['nombre'] : '') > 20) {
                $pdf->SetFont('helvetica', 'B', 8);
                $pdf->MultiCell($cellWidth, $cellHeight, substr(isset($dataRow['nombre']) ? $dataRow['nombre'] : '', 0, 20) . '...', 1, 'L');
            } else {
                $pdf->Cell($cellWidth, $cellHeight, isset($dataRow['nombre']) ? $dataRow['nombre'] : '', 1, 0, 'L');
            }
            
            // Repita para los demás campos...
            
            $pdf->Ln($cellHeight);
        } catch (Exception $e) {
            $pdf->Error('Error al generar la tabla: ' . $e->getMessage(), 'Error en la línea ' . $e->getLine());
        }
        
        // Verifica si se ha llenado una página completa
        if ($pdf->getPageCounter() > 1 && $currentRow % 20 == 0) {
            $pdf->AddPage();
            $pdf->Cell(0, 10, 'INFORME DE CLIENTES', 1, 0, 'C');
        }
        
        $currentRow++;
    }
}

// Salir del método AddPage
$pdf->Output('Informe_Clientes_' . date('d_m_y') . '.pdf', 'D');
?>
