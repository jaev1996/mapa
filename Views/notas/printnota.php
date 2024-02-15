<?php
//Incluimos librería y archivo de conexión
require 'public/Excel/Classes/PHPExcel.php';
//Consulta


//Objeto de PHPExcel
$objPHPExcel  = new PHPExcel();

//$logo1 = imagecreatefrompng('public/images/logos/homer.png');
//$logo2 = imagecreatefrompng('public/images/logos/logo2.png');
//Propiedades de Documento
$objPHPExcel->getProperties()->setCreator("MAPA")->setDescription("NOTA DE ENTREGA");
//Establecemos la pestaña activa y nombre a la pestaña
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle("NOTA DE ENTREGA");

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
	'style' => PHPExcel_Style_Border::BORDER_NONE
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
		'size' =>18
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
		$estiloSubtitulo = array(
			'font' => array(
			'name'      => 'Arial',
			'bold'      => true,
			'italic'    => false,
			'strike'    => false,
			'size' =>9
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
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			)
			);
			$estiloSubtotal = array(
				'font' => array(
				'name'      => 'Arial',
				'bold'      => true,
				'italic'    => false,
				'strike'    => false,
				'size' =>11
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
				$estiloTotal = array(
					'font' => array(
					'name'      => 'Arial',
					'bold'      => true,
					'italic'    => false,
					'strike'    => false,
					'size' =>11
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
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
					)
					);
			$estiloCaja = array(
				'font' => array(
				'name'      => 'Arial',
				'bold'      => true,
				'italic'    => false,
				'strike'    => false,
				'size' =>9
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
				$estiloCajaTitulo = array(
					'font' => array(
					'name'      => 'Arial',
					'bold'      => true,
					'italic'    => false,
					'strike'    => false,
					'size' =>14
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
			'type' => PHPExcel_Style_Fill::FILL_SOLID
			),
			'borders' => array(
			'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_NONE
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
				'size' =>10
				),
				'fill' => array(
				'type'  => PHPExcel_Style_Fill::FILL_SOLID
				),
				'borders' => array(
				'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
				)
				),
				'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
				)
				);




//RECIBIMOS LOS DATOS GENERALES DE LA NOTA DE ENTREGA

$fecha=$_POST['fecha'];
$fecha = date("d/m/Y", strtotime($fecha));
$nombreCliente=$_POST['nombreCliente'];
$codigoCliente=$_POST['codigoCliente'];
$direccionCliente=$_POST['direccionCliente'];
$numeroNota=$_POST['numeroNota'];
$tipoPago=$_POST['tipoPago'];
$vendedor=$_POST['vendedor'];

//RECIBIMOS LOS DATOS DE LOS REPUESTOS QUE SE ENCUENTRAN EN LA NOTA DE ENTREGA

$precioRep=$_POST['precioRep'];
$cantidadRep=$_POST['cantidadRep'];
$descripRep=$_POST['descripRep'];
$codigoRep=$_POST['codigoRep'];
$subtotal=$_POST['subtotal'];
$total=$_POST['total'];
$repeticiones=$_POST['repeticiones'];

$cantPag = $repeticiones / 25;
$cantPag = ceil($cantPag);

//ESTABLECEMOS LAS DIMENSIONES DE LAS CELDAS

//ESTABLECEMOS LA ALTURA DE LAS CELDAS DEL ENCABEZADO
$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);							
$objPHPExcel->getActiveSheet()->getRowDimension('4')->setRowHeight(24);							
						

//ESTABLECEMOS EL ANCHO DE TODAS LAS CELDAS
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(13);	
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);		
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(39);		
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(8);

$objPHPExcel->getActiveSheet()->getStyle('A:E')->getAlignment()->setWrapText(true);

//Ingresamos los encabezados de cada una de nuestras columnas
$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($estiloTituloReporte);
//$objPHPExcel->getActiveSheet()->getStyle('A2:E2')->applyFromArray($estiloTituloColumnas);
$objPHPExcel->getActiveSheet()->getStyle('A2:E2')->applyFromArray($estiloTituloEncabezado);
$objPHPExcel->getActiveSheet()->getStyle('A3:E3')->applyFromArray($estiloSubtitulo);
$objPHPExcel->getActiveSheet()->getStyle('A4:E4')->applyFromArray($estiloSubtitulo);
$objPHPExcel->getActiveSheet()->getStyle('A5:E5')->applyFromArray($estiloSubtitulo);
$objPHPExcel->getActiveSheet()->getStyle('A6:E6')->applyFromArray($estiloSubtitulo);
$objPHPExcel->getActiveSheet()->getStyle('A8:E8')->applyFromArray($estiloCajaTitulo);
$objPHPExcel->getActiveSheet()->getStyle('A9:E9')->applyFromArray($estiloCajaTitulo);
$objPHPExcel->getActiveSheet()->getStyle('A10:E10')->applyFromArray($estiloCaja);
$objPHPExcel->getActiveSheet()->getStyle('A11:E11')->applyFromArray($estiloCaja);

$objPHPExcel->getActiveSheet()->setCellValue('A1','MAPA MAYOR DE AUTOPARTES C.A.');
$objPHPExcel->getActiveSheet()->mergeCells('A1:E1');

$objPHPExcel->getActiveSheet()->mergeCells('D2:E2');
$objPHPExcel->getActiveSheet()->setCellValue('D2','CARACAS, '.$fecha);

$objPHPExcel->getActiveSheet()->setCellValue('A3','CLIENTE:');
$objPHPExcel->getActiveSheet()->mergeCells('B3:E3');
$objPHPExcel->getActiveSheet()->setCellValue('B3',$nombreCliente);
$objPHPExcel->getActiveSheet()->setCellValue('A4','DIRECCION:');
$objPHPExcel->getActiveSheet()->mergeCells('B4:E4');
$objPHPExcel->getActiveSheet()->setCellValue('B4',$direccionCliente);
$objPHPExcel->getActiveSheet()->setCellValue('A5','RIF/CED:');
$objPHPExcel->getActiveSheet()->mergeCells('B5:E5');
$objPHPExcel->getActiveSheet()->setCellValue('B5',$codigoCliente);
$objPHPExcel->getActiveSheet()->setCellValue('A6','TELF:');
$objPHPExcel->getActiveSheet()->mergeCells('B6:C6');
$objPHPExcel->getActiveSheet()->setCellValue('D8','N°'.$numeroNota);

$objPHPExcel->getActiveSheet()->mergeCells('A9:E9');
$objPHPExcel->getActiveSheet()->setCellValue('A9','NOTA DE ENTREGA');

$objPHPExcel->getActiveSheet()->getRowDimension('11')->setRowHeight(22);							
$objPHPExcel->getActiveSheet()->setCellValue('A11','CANT.');
$objPHPExcel->getActiveSheet()->setCellValue('B11','CODIGO');
$objPHPExcel->getActiveSheet()->setCellValue('C11','DESCRIPCION');
$objPHPExcel->getActiveSheet()->setCellValue('D11','PRECIO UNIT.');
$objPHPExcel->getActiveSheet()->setCellValue('E11','TOTAL.');



$celda = 12;


$inicio = 0;
$i = 0;
		if ($cantPag == 1) {
			while ($inicio < $repeticiones) {
				$celda++;
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$celda,$cantidadRep[$inicio]);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$celda,$codigoRep[$inicio]);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$celda,$descripRep[$inicio]);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$celda,$precioRep[$inicio]);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$celda,$subtotal[$inicio]);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':E'.$celda)->applyFromArray($estiloCaja);
				$inicio++;
			}
				$celda = 33;
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$celda.':E'.$celda);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$celda,'VISITANOS EN www.mayorautopartes.com');
				$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':E'.$celda)->applyFromArray($estiloFooter);
				$celda++;

				$objPHPExcel->getActiveSheet()->setCellValue('C'.$celda,'Sub-Total:');
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$celda,$total);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':C'.$celda)->applyFromArray($estiloTotal);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$celda.':F'.$celda)->applyFromArray($estiloSubtotal);
				$celda++;
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$celda,'IVA:');
				$objPHPExcel->getActiveSheet()->getStyle('E'.$celda.':F'.$celda)->applyFromArray($estiloSubtotal);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':C'.$celda)->applyFromArray($estiloTotal);
				$celda++;
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$celda,'TOTAL A PAGAR:');
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$celda,$total);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$celda.':F'.$celda)->applyFromArray($estiloSubtotal);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':C'.$celda)->applyFromArray($estiloTotal);
				$celda = 39;
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$celda.':E'.$celda);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':E'.$celda)->applyFromArray($estiloSubtitulo);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$celda,'CONDICIONES DE LA OFERTA:');
				$celda++;
				$objPHPExcel->getActiveSheet()->mergeCells('B'.$celda.':E'.$celda);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$celda,'PAGO:');
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$celda,$tipoPago);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':E'.$celda)->applyFromArray($estiloSubtitulo);
				$celda++;
				$objPHPExcel->getActiveSheet()->mergeCells('B'.$celda.':E'.$celda);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$celda,'VENDEDOR:');
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$celda,$vendedor);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':E'.$celda)->applyFromArray($estiloSubtitulo);
				
				$celda+=2;
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$celda.':E'.$celda);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$celda,'AV. PRINCIPAL CARICUAO, LOCAL No. 3, URB. UD-3, CARACAS- VENEZUELA ');
				$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':E'.$celda)->applyFromArray($estiloFooter);
		}
if ($cantPag == 2) {
	# code...
	while ($inicio < 25) {
		$celda++;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$celda,$cantidadRep[$inicio]);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$celda,$codigoRep[$inicio]);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$celda,$descripRep[$inicio]);
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$celda,$precioRep[$inicio]);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$celda,$subtotal[$inicio]);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':E'.$celda)->applyFromArray($estiloCaja);
		$inicio++;
	}
	$inicio = 25;
	
	$celda = 46;
	$objPHPExcel->getActiveSheet()->mergeCells('A'.$celda.':E'.$celda);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':E'.$celda)->applyFromArray($estiloSubtitulo);
	$objPHPExcel->getActiveSheet()->setCellValue('A'.$celda,'CONDICIONES DE LA OFERTA:');
	$celda++;
	$objPHPExcel->getActiveSheet()->mergeCells('B'.$celda.':E'.$celda);
	$objPHPExcel->getActiveSheet()->setCellValue('A'.$celda,'PAGO:');
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$celda,$tipoPago);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':E'.$celda)->applyFromArray($estiloSubtitulo);
	$celda++;
	$objPHPExcel->getActiveSheet()->mergeCells('B'.$celda.':E'.$celda);
	$objPHPExcel->getActiveSheet()->setCellValue('A'.$celda,'VENDEDOR:');
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$celda,$vendedor);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':E'.$celda)->applyFromArray($estiloSubtitulo);

	$celda+=2;
	$objPHPExcel->getActiveSheet()->mergeCells('A'.$celda.':E'.$celda);
	$objPHPExcel->getActiveSheet()->setCellValue('A'.$celda,'AV. PRINCIPAL CARICUAO, LOCAL No. 3, URB. UD-3, CARACAS- VENEZUELA ');
	$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':E'.$celda)->applyFromArray($estiloFooter);

	//INICIAMOS LA NUEVA PAGINA

	//ESTABLECEMOS LA ALTURA DE LAS CELDAS DEL ENCABEZADO
	$objPHPExcel->getActiveSheet()->getRowDimension('59')->setRowHeight(40);							
	$objPHPExcel->getActiveSheet()->getRowDimension('62')->setRowHeight(24);

	//Ingresamos los encabezados de cada una de nuestras columnas
	$objPHPExcel->getActiveSheet()->getStyle('A59:E59')->applyFromArray($estiloTituloReporte);
	//$objPHPExcel->getActiveSheet()->getStyle('A2:E2')->applyFromArray($estiloTituloColumnas);
	$objPHPExcel->getActiveSheet()->getStyle('A60:E60')->applyFromArray($estiloTituloEncabezado);
	$objPHPExcel->getActiveSheet()->getStyle('A61:E61')->applyFromArray($estiloSubtitulo);
	$objPHPExcel->getActiveSheet()->getStyle('A62:E62')->applyFromArray($estiloSubtitulo);
	$objPHPExcel->getActiveSheet()->getStyle('A63:E63')->applyFromArray($estiloSubtitulo);
	$objPHPExcel->getActiveSheet()->getStyle('A64:E64')->applyFromArray($estiloSubtitulo);
	$objPHPExcel->getActiveSheet()->getStyle('A66:E66')->applyFromArray($estiloCajaTitulo);
	$objPHPExcel->getActiveSheet()->getStyle('A67:E67')->applyFromArray($estiloCajaTitulo);
	$objPHPExcel->getActiveSheet()->getStyle('A68:E68')->applyFromArray($estiloCaja);
	$objPHPExcel->getActiveSheet()->getStyle('A69:E69')->applyFromArray($estiloCaja);

	$objPHPExcel->getActiveSheet()->setCellValue('A59','MAPA MAYOR DE AUTOPARTES C.A.');
	$objPHPExcel->getActiveSheet()->mergeCells('A59:E59');

	$objPHPExcel->getActiveSheet()->mergeCells('D60:E60');
	$objPHPExcel->getActiveSheet()->setCellValue('D60','CARACAS, '.$fecha);

	$objPHPExcel->getActiveSheet()->setCellValue('A61','CLIENTE:');
	$objPHPExcel->getActiveSheet()->mergeCells('B61:E61');
	$objPHPExcel->getActiveSheet()->setCellValue('B61',$nombreCliente);
	$objPHPExcel->getActiveSheet()->setCellValue('A62','DIRECCION:');
	$objPHPExcel->getActiveSheet()->mergeCells('B62:E62');
	$objPHPExcel->getActiveSheet()->setCellValue('B62',$direccionCliente);
	$objPHPExcel->getActiveSheet()->setCellValue('A63','RIF/CED:');
	$objPHPExcel->getActiveSheet()->mergeCells('B63:E63');
	$objPHPExcel->getActiveSheet()->setCellValue('B63',$codigoCliente);
	$objPHPExcel->getActiveSheet()->setCellValue('A64','TELF:');
	$objPHPExcel->getActiveSheet()->mergeCells('B64:C64');
	$objPHPExcel->getActiveSheet()->setCellValue('D66','N°'.$numeroNota);

	$objPHPExcel->getActiveSheet()->mergeCells('A67:E67');
	$objPHPExcel->getActiveSheet()->setCellValue('A67','NOTA DE ENTREGA');

	$objPHPExcel->getActiveSheet()->getRowDimension('69')->setRowHeight(22);							
	$objPHPExcel->getActiveSheet()->setCellValue('A69','CANT.');
	$objPHPExcel->getActiveSheet()->setCellValue('B69','CODIGO');
	$objPHPExcel->getActiveSheet()->setCellValue('C69','DESCRIPCION');
	$objPHPExcel->getActiveSheet()->setCellValue('D69','PRECIO UNIT.');
	$objPHPExcel->getActiveSheet()->setCellValue('E69','TOTAL.');
		$celda = 70;
		while ($inicio < $repeticiones) {
		$celda++;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$celda,$cantidadRep[$inicio]);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$celda,$codigoRep[$inicio]);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$celda,$descripRep[$inicio]);
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$celda,$precioRep[$inicio]);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$celda,$subtotal[$inicio]);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':E'.$celda)->applyFromArray($estiloCaja);
		$inicio++;
		}
		$celda=98;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$celda.':E'.$celda);
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$celda,'¡VISITANOS EN MAYORAUTOPARTES.COM!');
		$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':E'.$celda)->applyFromArray($estiloFooter);

		$celda = 100;
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$celda,'Sub-Total:');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$celda,$total);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':C'.$celda)->applyFromArray($estiloTotal);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$celda.':F'.$celda)->applyFromArray($estiloSubtotal);
		$celda++;
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$celda,'IVA:');
		$objPHPExcel->getActiveSheet()->getStyle('E'.$celda.':F'.$celda)->applyFromArray($estiloSubtotal);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':C'.$celda)->applyFromArray($estiloTotal);
		$celda++;
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$celda,'TOTAL A PAGAR:');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$celda,$total);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$celda.':F'.$celda)->applyFromArray($estiloSubtotal);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':C'.$celda)->applyFromArray($estiloTotal);

		$celda = 103;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$celda.':E'.$celda);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':E'.$celda)->applyFromArray($estiloSubtitulo);
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$celda,'CONDICIONES DE LA OFERTA:');
		$celda++;
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$celda.':E'.$celda);
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$celda,'PAGO:');
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$celda,$tipoPago);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':E'.$celda)->applyFromArray($estiloSubtitulo);
		$celda++;
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$celda.':E'.$celda);
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$celda,'VENDEDOR:');
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$celda,$vendedor);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':E'.$celda)->applyFromArray($estiloSubtitulo);

		
		$celda++;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$celda.':E'.$celda);
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$celda,'AV. PRINCIPAL CARICUAO, LOCAL No. 3, URB. UD-3, CARACAS- VENEZUELA ');
		$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':E'.$celda)->applyFromArray($estiloFooter);
}

		

		




header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Disposition: attachment;filename="Nota Nro '.$numeroNota.' '.$fecha.'.xlsx"');
header('Cache-Control: max-age=0');
$writer= new PHPExcel_Writer_Excel2007($objPHPExcel);
$writer->save('php://output');


?>
