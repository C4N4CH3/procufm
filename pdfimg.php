<?php
include('class.ezpdf.php');
$pdf =& new Cezpdf('a4');
$pdf->selectFont('fonts/courier.afm');
$pdf->ezText("<b>PDF con Imagenes en PHP</b>\n",20);
$pdf->ezText("Ejemplo de inclusi�n de imagenes en pdf\n\n",12);

$pdf->ezImage("img.jpg", 0, 420, 'none', 'left');

$pdf->ezText("<b>Fecha:</b> ".date("d/m/Y"),10);
$pdf->ezText("<b>Hora:</b> ".date("H:i:s"),10);
$pdf->ezText('<b>Fuente:</b> <c:alink:http://blog.unijimpe.net/>blog.unijimpe.net</c:alink>');
$pdf->ezStream();
?>

