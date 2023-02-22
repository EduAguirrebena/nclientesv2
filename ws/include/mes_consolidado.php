<?php

require 'excel/vendor/autoload.php';
require 'conexion.php';



$conexion = new conexion();
$conexion->conectar();
$bultos = array();
/*
$query_datos = "SELECT codigo_barras_bulto, DATE_FORMAT(FROM_UNIXTIME(timestamp_pedido), '%d-%m-%Y') AS 'fecha', concat(direccion_bulto, ', ', nombre_comuna) as direccion, email_bulto, nombre_bulto, telefono_bulto, pedido.id_pedido, nombre_comuna, carril_comuna, id_cliente FROM `bulto`
				INNER JOIN pedido ON (bulto.id_pedido=pedido.id_pedido)
				INNER JOIN comuna ON (bulto.id_comuna=comuna.id_comuna)
				WHERE estado_pedido>=2 AND bulto.id_pedido=$id_pedido";
*/

$query_datos = "SELECT 
c.id_cliente, c.email_cliente, dc.nombre_fantasia_datos_comerciales, 
bu.nombre_bulto, bu.direccion_bulto, bu.telefono_bulto, bu.email_bulto, bu.descripcion_bulto, bu.valor_declarado_bulto, bu.codigo_barras_bulto, bu.precio_bulto,  
bu.id_comuna, cc.nombre_comuna, p.timestamp_pedido, p.id_pedido 
FROM cliente c, comuna cc, pedido p, bodega b, bulto bu, paquete pq, datos_comerciales dc WHERE c.alta_cliente = 1 and c.id_cliente = p.id_cliente and b.id_bodega = p.id_bodega and bu.id_pedido = p.id_pedido and cc.id_comuna = bu.id_comuna and pq.id_paquete = bu.id_paquete and p.timestamp_pedido >= ".$_GET['from']." and p.timestamp_pedido <= ".$_GET['to']." and dc.id_cliente = c.id_cliente AND c.id_cliente = '".$_GET["id_cliente"]."' AND p.gestionado_pedido = 1  
group by c.id_cliente, c.email_cliente, dc.nombre_fantasia_datos_comerciales, 
bu.nombre_bulto, bu.direccion_bulto, bu.telefono_bulto, bu.email_bulto, bu.descripcion_bulto, bu.valor_declarado_bulto, bu.codigo_barras_bulto, bu.precio_bulto,  
bu.id_comuna, cc.nombre_comuna, p.timestamp_pedido, p.id_pedido";
if($datos = $conexion->mysqli->query($query_datos)) {
	while($dato = $datos->fetch_object()) {
		$bultos[] = $dato;
	}
}
else {
	echo $conexion->mysqli->error;
	$conexion->desconectar();
	exit();
}
/*
echo $query_datos; die();
print_r($bultos);
die();
*/
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(12);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(10);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(10);
$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(10);
$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(10);
$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(10);
$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(18);
$sheet->setCellValue('A1', 'ID CLIENTE');
$sheet->setCellValue('B1', 'NOMBRE_FANTASIA');
$sheet->setCellValue('C1', 'ID PEDIDO');
$sheet->setCellValue('D1', 'FECHA PEDIDO');
$sheet->setCellValue('E1', 'NOMBRE BULTO');
$sheet->setCellValue('F1', 'DIRECCION BULTO');
$sheet->setCellValue('G1', 'TELEFONO_BULTO');
$sheet->setCellValue('H1', 'EMAIL BULTO');
$sheet->setCellValue('I1', 'DESCRIPCION BULTO');
$sheet->setCellValue('J1', 'VALOR DECLARADO');
$sheet->setCellValue('K1', 'CODIGO BARRAS');
$sheet->setCellValue('L1', 'PRECIO BULTO');
$sheet->setCellValue('M1', 'ID COMUNA');
$sheet->setCellValue('N1', 'NOMBRE COMUNA');

$i=2;


foreach($bultos AS $bulto) {

$sheet->setCellValue('A'.$i, $bulto->id_cliente);
$sheet->setCellValue('B'.$i, $bulto->nombre_fantasia_datos_comerciales);
$sheet->setCellValue('C'.$i, $bulto->id_pedido);
$sheet->setCellValue('D'.$i, date("d/m/Y H:i",$bulto->timestamp_pedido));
$sheet->setCellValue('E'.$i, $bulto->nombre_bulto);
$sheet->setCellValue('F'.$i, $bulto->direccion_bulto);
$sheet->setCellValue('G'.$i, $bulto->telefono_bulto);
$sheet->setCellValue('H'.$i, $bulto->email_bulto);
$sheet->setCellValue('I'.$i, $bulto->descripcion_bulto);
$sheet->setCellValue('J'.$i, $bulto->valor_declarado_bulto);
$sheet->setCellValue('K'.$i, $bulto->codigo_barras_bulto);
$sheet->setCellValue('L'.$i, $bulto->precio_bulto);
$sheet->setCellValue('M'.$i, $bulto->id_comuna);
$sheet->setCellValue('N'.$i, $bulto->nombre_comuna);
$i++;

}












$writer = new Xlsx($spreadsheet);
$writer->save("cierre ".$bultos[0]->nombre_fantasia_datos_comerciales." ".$_GET["periodo"].".xlsx");
// Redireccionamos para que descargue el archivo generado
header("Location: cierre ".$bultos[0]->nombre_fantasia_datos_comerciales." ".$_GET["periodo"].".xlsx");