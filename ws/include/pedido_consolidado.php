<?php

$id_pedido = filter_input(INPUT_GET, "id_pedido", FILTER_SANITIZE_NUMBER_INT);
if(!is_numeric($id_pedido) || empty($id_pedido)) {
	exit();
}

require 'excel/vendor/autoload.php';
require 'conexion.php';



$conexion = new conexion();
$conexion->conectar();
$bultos = array();

$query_datos = "SELECT codigo_barras_bulto, DATE_FORMAT(FROM_UNIXTIME(timestamp_pedido), '%d-%m-%Y') AS 'fecha', concat(direccion_bulto, ', ', nombre_comuna) as direccion, email_bulto, nombre_bulto, telefono_bulto, pedido.id_pedido, nombre_comuna, carril_comuna, id_cliente FROM `bulto`
				INNER JOIN pedido ON (bulto.id_pedido=pedido.id_pedido)
				INNER JOIN comuna ON (bulto.id_comuna=comuna.id_comuna)
				WHERE estado_pedido>=2 AND bulto.id_pedido=$id_pedido";

if($datos = $conexion->mysqli->query($query_datos)) {
	while($dato = $datos->fetch_object()) {
		array_push($bultos, $dato);
	}
}
else {
	echo $conexion->mysqli->error;
	$conexion->desconectar();
	exit();
}

$bultos = (object)$bultos;

function upca($upc_code) {
	$upc = substr($upc_code,0,11);
	if (strlen($upc) == 11 && strlen($upc_code) <= 12) { $oddPositions = $upc[0] + $upc[2] + $upc[4] + $upc[6] + $upc[8] + $upc[10]; $oddPositions *= 3; $evenPositions= $upc[1] + $upc[3] + $upc[5] + $upc[7] + $upc[9]; $sumEvenOdd = $oddPositions + $evenPositions; $checkDigit = (10 - ($sumEvenOdd % 10)) % 10; } return $upc_code.$checkDigit;
}





use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(10);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(10);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(10);
$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(5);
$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(5);
$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(5);
$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(8);
$sheet->setCellValue('A1', 'SOC');
$sheet->setCellValue('B1', 'SHIPMENT');
$sheet->setCellValue('C1', 'FECHA TRL');
$sheet->setCellValue('D1', 'DIRECCIÓN');
$sheet->setCellValue('E1', 'ID. CONTACTO');
$sheet->setCellValue('F1', 'NOMBRE CONTACTO');
$sheet->setCellValue('G1', 'TELÉFONO');
$sheet->setCellValue('H1', 'EMAIL CONTACTO');
$sheet->setCellValue('I1', 'CT ORIGEN');
$sheet->setCellValue('J1', 'F12');
$sheet->setCellValue('K1', 'COMUNA');
$sheet->setCellValue('L1', 'TRL');
$sheet->setCellValue('M1', 'RH');
$sheet->setCellValue('N1', 'CARRIL');

$i=2;


/* Rescatar bodega */
$query_bodega = "SELECT b.*, c.nombre_comuna, c1.email_cliente, d.nombre_fantasia_datos_comerciales, d.telefono_datos_comerciales, c.carril_comuna FROM pedido p 
				INNER JOIN bodega b ON b.id_bodega = p.id_bodega 
				INNER JOIN comuna c ON c.id_comuna = b.id_comuna 
				INNER JOIN cliente c1 ON c1.id_cliente = b.id_cliente 
				INNER JOIN datos_comerciales d ON d.id_cliente = c1.id_cliente
				WHERE p.id_pedido=$id_pedido";

if($la_bodega = $conexion->mysqli->query($query_bodega)) {
	$bodega = $la_bodega->fetch_object();
}

foreach($bultos AS $bulto) {
	$bulto_base = $bulto;
	break;
}

$unwanted_array = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );

$cm = $bodega->nombre_comuna;
$cm = strtr( $cm, $unwanted_array );
$cm = strtr( $cm, $unwanted_array );
$cm = strtoupper($cm);


$sheet->setCellValue('A'.$i, "R".$id_pedido."");
$sheet->setCellValue('B'.$i, "");
$sheet->setCellValue('C'.$i, ucwords(strtolower($bulto_base->fecha)));
$sheet->setCellValue('D'.$i, ucwords($bodega->calle_bodega." ".$bodega->numero_bodega.", ").$cm);
$sheet->setCellValue('E'.$i, strtolower($bodega->email_cliente));
$sheet->setCellValue('F'.$i, ucwords(strtolower($bodega->nombre_fantasia_datos_comerciales)));
$sheet->setCellValue('G'.$i, "56".$bodega->telefono_datos_comerciales);
$sheet->setCellValue('H'.$i, strtolower($bodega->email_cliente));
$sheet->setCellValue('I'.$i, "CD V");
$sheet->setCellValue('J'.$i, "R".$id_pedido."");
$sheet->setCellValue('K'.$i, $cm);
$sheet->setCellValue('L'.$i, $bulto_base->id_pedido);
$sheet->setCellValue('M'.$i, "AD");
$sheet->setCellValue('N'.$i, $bodega->carril_comuna);
$i++;

foreach($bultos AS $bulto) {

	$cm = $bulto->nombre_comuna;
	$cm = strtr( $cm, $unwanted_array );
	$cm = strtr( $cm, $unwanted_array );
	$cm = strtoupper($cm);

	$ad = $bulto->direccion;
	$ad = strtr( $ad, $unwanted_array );
	$ad = strtr( $ad, $unwanted_array );
	$ad = strtoupper($ad);

	//$sheet->setCellValue('A'.$i, $bulto->codigo_barras_bulto.upca($bulto->codigo_barras_bulto." "));
	//$sheet->getStyleByColumnAndRow(1, $i) ->getNumberFormat() ->setFormatCode(NumberFormat::FORMAT_TEXT);
	$sheet->getCellByColumnAndRow(0, $i)->setValueExplicit(upca($bulto->codigo_barras_bulto),\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);

	$sheet->setCellValue('C'.$i, ucwords(strtolower($bulto->fecha)));
	$sheet->setCellValue('D'.$i, $ad); //ucwords(strtolower($bulto->direccion))
	$sheet->setCellValue('E'.$i, strtolower($bulto->email_bulto));
	$sheet->setCellValue('F'.$i, ucwords(strtolower($bulto->nombre_bulto)));
	$sheet->setCellValue('G'.$i, strtolower($bulto->telefono_bulto));
	$sheet->setCellValue('H'.$i, strtolower($bulto->email_bulto));
	$sheet->setCellValue('I'.$i, "CD V");
	$sheet->setCellValue('J'.$i, $bulto->id_cliente);
	$sheet->setCellValue('K'.$i, $cm);
	$sheet->setCellValue('L'.$i, $bulto->id_pedido);
	$sheet->setCellValue('M'.$i, "AD");
	$sheet->setCellValue('N'.$i, $bulto->carril_comuna);
	$i++;
}













$writer = new Xlsx($spreadsheet);
$writer->save("pedido $id_pedido consolidado.xlsx");
// Redireccionamos para que descargue el archivo generado
header("Location: pedido $id_pedido consolidado.xlsx");