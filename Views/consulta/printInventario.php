<?php
//Incluimos librería y archivo de conexión
require 'public/Excel/Classes/PHPExcel.php';
require 'libs/conexionaux.php';
//Consulta
$sqlTipo = "SELECT * FROM tiporepuesto ORDER BY descripTipo";
$resultado = $mysqli->query($sqlTipo);

//Objeto de PHPExcel
$objPHPExcel  = new PHPExcel();

//$logo1 = imagecreatefrompng('public/images/logos/homer.png');
//$logo2 = imagecreatefrompng('public/images/logos/logo2.png');
//Propiedades de Documento
$objPHPExcel->getProperties()->setCreator("MAPA")->setDescription("LISTA MAPA");
//Establecemos la pestaña activa y nombre a la pestaña
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle("LISTA MAPA");

/*
	$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
	$objDrawing->setName('Logo1');
	$objDrawing->setDescription('Logo1');
	$objDrawing->setImageResource($logo1);
	$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
	$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
	$objDrawing->setHeight(120);
	$objDrawing->setCoordinates('A1');
	$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

	$objDrawing2 = new PHPExcel_Worksheet_MemoryDrawing();
	$objDrawing2->setName('Logo2');
	$objDrawing2->setDescription('Logo2');
	$objDrawing2->setImageResource($logo2);
	$objDrawing2->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
	$objDrawing2->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
	$objDrawing2->setHeight(120);
	$objDrawing2->setCoordinates('E1');
	$objDrawing2->setWorksheet($objPHPExcel->getActiveSheet());

*/




//Establecemos el estilo de las celdas
$estiloTituloColumnas = array(
    'font' => array(
	'name'  => 'Arial',
	'bold'  => true,
	'size' =>8,
	'color' => array(
	'rgb' => '000000'
	)
    ),
    'borders' => array(
	'allborders' => array(
	'style' => PHPExcel_Style_Border::BORDER_THIN
	)
    ),
    'alignment' =>  array(
	'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
    )
	);

	$estiloTituloReporte = array(
		'font' => array(
		'name'      => 'Arial',
		'bold'      => true,
		'italic'    => false,
		'strike'    => false,
		'size' =>13
		),
		'fill' => array(
		'type'  => PHPExcel_Style_Fill::FILL_SOLID
		),
		'borders' => array(
		'allborders' => array(
		'style' => PHPExcel_Style_Border::BORDER_NONE
		)
		),
		'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
		)
		);

		$estiloTituloEncabezado = array(
			'font' => array(
			'name'  => 'Arial',
			'bold'  => true,
			'size' =>8,
			'color' => array(
			'rgb' => '000000'
			)
			),
			'fill' => array(
			'type' => PHPExcel_Style_Fill::FILL_SOLID,
			),
			'borders' => array(
			'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN
			)
			),
			'alignment' =>  array(
			'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
			)
			);

			$estiloFooter= array(
				'font' => array(
				'name'      => 'Arial',
				'bold'      => false,
				'italic'    => false,
				'strike'    => false,
				'size' =>8
				),
				'fill' => array(
				'type'  => PHPExcel_Style_Fill::FILL_SOLID
				),
				'borders' => array(
				'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_NONE
				)
				),
				'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
				)
				);







$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);							
$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);							
			
										
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12);	
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);		
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);		
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(8);

$objPHPExcel->getActiveSheet()->getStyle('A:E')->getAlignment()->setWrapText(true);
	
//Ingresamos los encabezados de cada una de nuestras columnas
$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($estiloTituloReporte);
$objPHPExcel->getActiveSheet()->getStyle('A2:E2')->applyFromArray($estiloTituloColumnas);
$objPHPExcel->getActiveSheet()->getStyle('A3:E3')->applyFromArray($estiloTituloEncabezado);

$objPHPExcel->getActiveSheet()->setCellValue('A1','MAPA MAYOR DE AUTOPARTES C.A.');
$objPHPExcel->getActiveSheet()->mergeCells('A1:E1');

$objPHPExcel->getActiveSheet()->mergeCells('A2:E2');
$objPHPExcel->getActiveSheet()->setCellValue('A2','RIF.J-412365126');

$celda = 4;


$objPHPExcel->getActiveSheet()->setCellValue('A3', 'CODIGO');
$objPHPExcel->getActiveSheet()->setCellValue('B3', 'DESCRIPCION');
$objPHPExcel->getActiveSheet()->setCellValue('C3', 'MARCA');
$objPHPExcel->getActiveSheet()->setCellValue('D3', 'CANT.');
$objPHPExcel->getActiveSheet()->setCellValue('E3', 'PRECIO (SIN IVA)');

$fecha=$_POST['fecha'];
$tipo=$_POST['tipo'];
$sqlRep="";
$idTipo="";
if ($tipo == 0) {
	$nombreReporte = "DISPONIBLE";
}else {
	$nombreReporte = "TOTAL";
}

	 while($rowTipo = $resultado->fetch_assoc()){
		$idTipo = $rowTipo['idTipo'];
		if ($tipo == 0) {
			$sqlRep = "SELECT * FROM repuestos WHERE idTipo = $idTipo AND cantidadRep > 0";
		}else {
			$sqlRep = "SELECT * FROM repuestos WHERE idTipo = $idTipo";
		}
		
		
		$resultadoRep = $mysqli->query($sqlRep);
		$row_cnt = mysqli_num_rows($resultadoRep);
		if ( $row_cnt > 0) {
			$objPHPExcel->getActiveSheet()->getRowDimension($celda)->setRowHeight(30);							

			$objPHPExcel->getActiveSheet()->mergeCells('A'.$celda.':E'.$celda);
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$celda,$rowTipo['descripTipo']);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':E'.$celda)->applyFromArray($estiloTituloReporte);
			$celda++;
			// La consulta regresó al menos una fila
		} else {
			// La consulta no regresó ninguna fila
		}
		

		while ($rows = $resultadoRep->fetch_assoc()) {
			$idMarca = $rows['idMarca'];
			$sqlMarca = "SELECT * FROM marcarepuesto WHERE idMarca = $idMarca";
			$resultadoMarca = $mysqli->query($sqlMarca);
			$rowMarca = $resultadoMarca->fetch_assoc();
			$val = number_format($rows['precioRep'],2,'.','');
			if ($tipo == 1) {
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$celda,$rows['codigoRep']);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$celda, utf8_encode($rows['descripRep']));
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$celda,$rowMarca['descripMarca']);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$celda,$rows['cantidadRep']);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$celda,$val);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':E'.$celda)->applyFromArray($estiloTituloColumnas);
				$celda++;
			}elseif ($tipo == 0) {
				if ($rows['cantidadRep'] > 0) {
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$celda,$rows['codigoRep']);
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$celda, utf8_encode($rows['descripRep']));
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$celda,$rowMarca['descripMarca']);
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$celda,$rows['cantidadRep']);
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$celda,$val);
					$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':E'.$celda)->applyFromArray($estiloTituloColumnas);
					$celda++;
				}
			}
			
			
			
			/*$phrase  = "You should eat fruits, vegetables, and fiber every day.";
			$healthy = array("fruits", "vegetables", "fiber");
			$yummy   = array("pizza", "beer", "ice cream"); 
			*/
			/*setlocale(LC_MONETARY,"en_US");
			$rows['precioRep'] = money_format("%10.2n",$rows['precioRep']);
			*/
			
			

		}
		//$objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, $rows['precio']);
		//$objPHPExcel->getActiveSheet()->setCellValue('D'.$fila, $rows['existencia']);
		//$objPHPExcel->getActiveSheet()->setCellValue('E'.$fila, '=C'.$fila.'*D'.$fila);
		
		 //Sumamos 1 para pasar a la siguiente fila
	}

header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Disposition: attachment;filename="LISTA MAPA '.$nombreReporte." ".$fecha.'.xlsx"');
header('Cache-Control: max-age=0');
$writer= new PHPExcel_Writer_Excel2007($objPHPExcel);
$writer->save('php://output');


?>
