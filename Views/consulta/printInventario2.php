<?php
//Incluimos librería y archivo de conexión
require 'public/Excel/Classes/PHPExcel.php';
//Consulta




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
			'size' =>10,
			'color' => array(
			'rgb' => '000000'
			)
			),
			'fill' => array(
			'type' => PHPExcel_Style_Fill::FILL_SOLID,
			'color' => array('rgb' => 'FDE9D9')
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


				

//Objeto de PHPExcel
$objPHPExcel  = new PHPExcel();

/*
				$rtotales = $_POST['rtotales'];


				$fecha=$_POST['fecha'];
				$repeticiones=$_POST['repeticiones'];
				$conteoTipos=$_POST['conteoTipos'];
				
				$idTipo=$_POST['idTipo'];
				$descripTipo=$_POST['descripTipo'];
				
				
				$precioRep=$_POST['precioRep'];
				$cantidadRep=$_POST['cantidadRep'];
				$idMarca=$_POST['idMarca'];
				$descripRep=$_POST['descripRep'];
				$codigoRep=$_POST['codigoRep'];

				$fecha2=$_POST['fecha2'];
				$repeticiones2=$_POST['repeticiones2'];
				$conteoTipos2=$_POST['conteoTipos2'];
				
				$idTipo2=$_POST['idTipo2'];
				$descripTipo2=$_POST['descripTipo2'];
				
				
				$precioRep2=$_POST['precioRep2'];
				$cantidadRep2=$_POST['cantidadRep2'];
				$idMarca2=$_POST['idMarca2'];
				$descripRep2=$_POST['descripRep2'];
				$codigoRep2=$_POST['codigoRep2'];
*/
//$logo1 = imagecreatefrompng('public/images/logos/homer.png');
//$logo2 = imagecreatefrompng('public/images/logos/logo2.png');
//Propiedades de Documento
$objPHPExcel->getProperties()->setCreator("MAPA")->setDescription("LISTA MAPA");
//Establecemos la pestaña activa y nombre a la pestaña
/*$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle("LISTA MAPA");
$sheet = $objPHPExcel->getActiveSheet(); */
 /*$j=0; 
 while ($j < 3) { 
	  $objWorkSheet = $objPHPExcel->createSheet($j);  
	  $objWorkSheet->getRowDimension('1')->setRowHeight(60);							
	  $objWorkSheet->getRowDimension('2')->setRowHeight(30);							
				  
											  
	  $objWorkSheet->getColumnDimension('A')->setWidth(14);	
	  $objWorkSheet->getColumnDimension('B')->setWidth(60);		
	  $objWorkSheet->getColumnDimension('C')->setWidth(20);		
	  $objWorkSheet->getColumnDimension('D')->setWidth(12);
	  $objWorkSheet->getColumnDimension('E')->setWidth(14);
	  
	  $objWorkSheet->getStyle('A:E')->getAlignment()->setWrapText(true);
		  
	  //Ingresamos los encabezados de cada una de nuestras columnas
	  $objWorkSheet->getStyle('A1:E1')->applyFromArray($estiloTituloReporte);
	  $objWorkSheet->getStyle('A2:E2')->applyFromArray($estiloTituloColumnas);
	  $objWorkSheet->getStyle('A3:E3')->applyFromArray($estiloTituloEncabezado);
	  
	  $objWorkSheet->setCellValue('A1','MAPA MAYOR DE AUTOPARTES C.A.');
	  $objWorkSheet->mergeCells('A1:E1');
	  
	  $objWorkSheet->mergeCells('A2:E2');
	  $objWorkSheet->setCellValue('A2','RIF.J-412365126');
	  
	  $celda = 4;
	  
	  
	  $objWorkSheet->setCellValue('A3', 'CODIGO');
	  $objWorkSheet->setCellValue('B3', 'DESCRIPCION');
	  $objWorkSheet->setCellValue('C3', 'MARCA');
	  $objWorkSheet->setCellValue('D3', 'CANTIDAD');
	  $objWorkSheet->setCellValue('E3', 'PRECIO EN PREPAGO
	  (SIN IVA)');
	  $inicio = 0;
	$i = 0;
	$contadoraux = 0;
	while ($i < $conteoTipos) {
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$celda.':E'.$celda);
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$celda,$descripTipo[$i]);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':E'.$celda)->applyFromArray($estiloTituloReporte);

		while ($inicio < $repeticiones[$i]) {
			$contadoraux++;
			$celda++;
			if ($contadoraux >= 150) {
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$celda,$codigoRep2[$contadoraux]);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$celda,$descripRep2[$contadoraux]);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$celda,$idMarca2[$contadoraux]);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$celda,$cantidadRep2[$contadoraux]);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$celda,$precioRep2[$contadoraux]);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':E'.$celda)->applyFromArray($estiloTituloColumnas);
			$inicio++;
			}if ($contadoraux < 150) {
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$celda,$codigoRep[$contadoraux]);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$celda,$descripRep[$contadoraux]);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$celda,$idMarca[$contadoraux]);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$celda,$cantidadRep[$contadoraux]);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$celda,$precioRep[$contadoraux]);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':E'.$celda)->applyFromArray($estiloTituloColumnas);
			$inicio++;
			}
		}
		$inicio = $repeticiones[$i];
        $celda++;
        $i++;
	 }

	 
	  $objWorkSheet->setTitle("$j"); $j++; }
 $objPHPExcel->setActiveSheetIndex(0);

*/

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











$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(60);							
$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(30);							
			
										
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(14);	
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(60);		
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);		
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(14);

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
$objPHPExcel->getActiveSheet()->setCellValue('D3', 'CANTIDAD');
$objPHPExcel->getActiveSheet()->setCellValue('E3', 'PRECIO EN PREPAGO
(SIN IVA)');

$fecha=$_POST['fecha'];
$repeticiones=$_POST['repeticiones'];
$conteoTipos=$_POST['conteoTipos'];

$idTipo=$_POST['idTipo'];
$descripTipo=$_POST['descripTipo'];


$precioRep=$_POST['precioRep'];
$cantidadRep=$_POST['cantidadRep'];
$idMarca=$_POST['idMarca'];
$descripRep=$_POST['descripRep'];
$codigoRep=$_POST['codigoRep'];
$inicio = 0;
$i = 0;
	while ($i < $conteoTipos) {
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$celda.':E'.$celda);
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$celda,$descripTipo[$i]);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':E'.$celda)->applyFromArray($estiloTituloReporte);

		while ($inicio < $repeticiones[$i]) {
			$celda++;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$celda,$codigoRep[$inicio]);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$celda,$descripRep[$inicio]);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$celda,$idMarca[$inicio]);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$celda,$cantidadRep[$inicio]);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$celda,$precioRep[$inicio]);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':E'.$celda)->applyFromArray($estiloTituloColumnas);
        	$inicio++;
		}
		$inicio = $repeticiones[$i];
        $celda++;
        $i++;
	 }
//Establecemos la pestaña activa y nombre a la pestaña

$writer= new PHPExcel_Writer_Excel2007($objPHPExcel);
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Disposition: attachment;filename="LISTA MAPA.xlsx"');
header('Cache-Control: max-age=0');
$writer->save('php://output');

?>
