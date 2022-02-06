<?php
	$peticionAjax=true;
    require_once "../config/APP.php";

	$id=(isset($_GET['id'])) ? $_GET['id'] : 0 ;
	
	//instancia al controlador
	require_once "../controladores/mantenimientoControlador.php";
	$ins_mantenimiento = new mantenimientoControlador();

	$datos_mantenimiento=$ins_mantenimiento->datos_mantenimiento_controlador("Unico",$id);

if($datos_mantenimiento->rowCount()==1){
	$datos_mantenimiento=$datos_mantenimiento->fetch();

		//instancia al controlador entidad
		require_once "../controladores/mantenimientoControlador.php";
		$ins_mantenimiento = new mantenimientoControlador();

		//instancia al controlador euqipo de computo
		require_once "../controladores/equipoControlador.php";
		$ins_equipo = new equipoControlador();

		$datos_equipo=$ins_equipo->datos_equipo_controlador("Unico",$ins_equipo->encryption($datos_mantenimiento['id_equipo_mante']));
		$datos_equipo=$datos_equipo->fetch();


	require "./fpdf.php";

	$pdf = new FPDF('P','mm','Letter');
	$pdf->SetMargins(17,17,17);
	$pdf->AddPage();
	$pdf->Image('../vistas/assets/avatar/drtc-apurimac.png',10,10,30,30,'PNG');

	$pdf->SetFont('Arial','B',18);
	$pdf->SetTextColor(0,107,181);
	$pdf->Cell(0,10,utf8_decode(strtoupper("Reporte de mantenimiento")),0,0,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(33,33,33);
	$pdf->Cell(-35,10,utf8_decode('N. de mantenimiento'),'',0,'C');

	$pdf->Ln(10);	

	$pdf->SetFont('Arial','',15);
	$pdf->SetTextColor(0,107,181);
	$pdf->Cell(0,10,utf8_decode(""),0,0,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(-35,10,utf8_decode("000".$datos_mantenimiento['id_mante_equipo']),'',0,'C');

	$pdf->Ln(25);

	$pdf->SetTextColor(33,33,33);
	$pdf->Cell(36,8,utf8_decode('Fecha de entrada:'),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(27,8,utf8_decode(date("d/m/Y", strtotime($datos_mantenimiento['fecha_entrada']))),0,0);
	$pdf->Ln(7);
	$pdf->SetTextColor(33,33,33);
	$pdf->Cell(36,8,utf8_decode('Hora de entrada:'),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(27,8,utf8_decode(date("G:i", strtotime($datos_mantenimiento['hora_entrada']))),0,0);
	$pdf->Ln(10);
	$pdf->SetTextColor(33,33,33);
	$pdf->Cell(36,8,utf8_decode('Fecha de salida:'),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(27,8,utf8_decode(date("d/m/Y", strtotime($datos_mantenimiento['fecha_salida']))),0,0);
	$pdf->Ln(7);
	$pdf->SetTextColor(33,33,33);
	$pdf->Cell(36,8,utf8_decode('Hora de salida:'),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(27,8,utf8_decode(date("G:i", strtotime($datos_mantenimiento['hora_salida']))),0,0);

	$pdf->Ln(15);
	$pdf->SetTextColor(33,33,33);
	$pdf->Cell(27,8,utf8_decode('Atendido por:'),"",0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(13,8,utf8_decode("Ing. Nicanor Jhonatan Leon Reynoso"),0,0);

	$pdf->Ln(15);

	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(33,33,33);
	$pdf->Cell(15,8,utf8_decode('Area:'),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(65,8,utf8_decode($datos_equipo['area_designada']),0,0);
	$pdf->SetTextColor(33,33,33);
	

	

	$pdf->Ln(15);

	$pdf->SetFillColor(38,198,208);
	$pdf->SetDrawColor(38,198,208);
	$pdf->SetTextColor(33,33,33);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(15,10,utf8_decode('ID Equipo'),1,0,'C',true);
	$pdf->Cell(90,10,utf8_decode('Descripcion'),1,0,'C',true);
	$pdf->Cell(76,10,utf8_decode('Equipo'),1,0,'C',true);
	

	$pdf->Ln(10);

	$pdf->SetTextColor(97,97,97);


	$pdf->Cell(15,10,utf8_decode($datos_mantenimiento['id_equipo_mante']),'L',0,'C');
	$pdf->Cell(90,10,utf8_decode($datos_mantenimiento['observacion']),'L',0,'C');
	$pdf->Cell(76,10,utf8_decode($datos_equipo['tipo_compu']),'LR',0,'C');
	
	

	$pdf->Ln(10);

	$pdf->SetTextColor(33,33,33);
	$pdf->Cell(15,10,utf8_decode(''),'T',0,'C');
	$pdf->Cell(90,10,utf8_decode(''),'T',0,'C');
	$pdf->Cell(51,10,utf8_decode(''),'T',0,'C');
	$pdf->Cell(25,10,utf8_decode(''),'T',0,'C');

	$pdf->Ln(15);

	$pdf->Cell(0,9,utf8_decode("Estado: ".$datos_mantenimiento['estado_matenimiento']),1,'J',FALSE);

	

	$pdf->Ln(25);

	/*----------  INFO. ENTIDAD  ----------*/
	$pdf->SetFont('Arial','B',9);
	$pdf->SetTextColor(33,33,33);
	$pdf->Cell(0,6,utf8_decode("Direccion Regiona de Transportes y Comunicaciones"),0,0,'C');
	$pdf->Ln(6);
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(0,6,utf8_decode("Oficina de informatica	"),0,0,'C');
	$pdf->Ln(6);
	$pdf->Cell(0,6,utf8_decode("Teléfono: 957 240 637 "),0,0,'C');
	$pdf->Ln(6);
	


	$pdf->Output("I","Factura_1.pdf",true);
}else{
	?>
	<!DOCTYPE html>
	<html lang="es">
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-sacale=1.0">
			<title><?php echo COMPANY; ?></title>
			<?php include "../vistas/inc/Link.php";?>
		<head>
		<body>
		<div class="full-box container-404">
			<div>
				<p class="text-center"><i class="fas fa-rocket fa-10x"></i></p>
				<h1 class="text-center">ocurrio un error</h1>
				<p class="lead text-center">No hemos encontrado el mantenimiento seleccionado</p>
			</div>
		</div>
			<?php include "../vistas/inc/Script.php"; ?>
		</body>
	</html>
	
	<?php } ?>