<?php 
session_start();
if(!isset($_SESSION['cliente'])):
    header("Location: ../index.php");
endif;

// $administrador = $_SESSION['cliente']->rol;

// if($administrador == 1) { 
//     exit();
// }

require_once('../ws/bd/dbconn.php');
$conexion = new bd();
$conexion->conectar();

$fecha_actual = date("d-m-Y");
$fecha_busqueda = date("d-m-Y",strtotime($fecha_actual."- 45 days"));
$fecha_timestamp = strtotime($fecha_busqueda);


if($datos_pedidos = $conexion->mysqli->query("SELECT * FROM pedido 
                                            INNER JOIN datos_contacto ON (pedido.id_cliente=datos_contacto.id_cliente)
                                            WHERE pedido.timestamp_pedido > $fecha_timestamp ORDER BY timestamp_pedido DESC")) {
    $pedidos = array();
    while ($dato = $datos_pedidos->fetch_object()) {
        $pedidos[] = $dato;
    }
    $datos_pedidos->close();
}
else {
    echo $conexion->mysqli->error;
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
    <?php
        include_once('../include/head.php');
    ?>



    <body>
        <div id="app">
            <!-- SideBar -->
            <?php
                include_once('../include/sidebar.php');
            ?>
        
            <div id="main"  class="layout-navbar">
                <?php
                    include_once('../include/topbar.php');
                ?>
        
                <div class="page-content">
                    <div class="resumen-envios row m-2">
                        <div class="row">
                            <h4 style="color:#3e3e3f">Pedidos Administración</h4>
                        </div>
                    <div class="masteresume row">
                        <div class="col card">
                            <table class="table nowrap" style="max-width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Cliente</th>
                                        <th>Teléfono</th>
                                        <th>Email</th>
                                        <th>Fecha creación</th>
                                        <th>Cantidad Bultos</th>
                                        <th>Cantidad objetados</th>
                                        <th>Finalizado</th>
                                        <th>Pagado</th>
                                        <th style="width: 10px"> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    foreach($pedidos as $pedido):
                                        $carga_archivos = $conexion->mysqli->query("SELECT * FROM archivo WHERE id_pedido=$pedido->id_pedido")->num_rows;
                                        $procesado_archivo = $conexion->mysqli->query("SELECT * FROM archivo WHERE procesado_archivo=1 AND id_pedido=$pedido->id_pedido")->num_rows;
                                        $cantidad_bultos = $conexion->mysqli->query("SELECT * FROM bulto WHERE id_pedido=$pedido->id_pedido")->num_rows + $conexion->mysqli->query("SELECT * FROM bulto_temporal WHERE id_pedido=$pedido->id_pedido")->num_rows;
                                        $cantidad_objetados = $conexion->mysqli->query("SELECT * FROM bulto_temporal WHERE CHAR_LENGTH(json_error)>5 AND id_pedido=$pedido->id_pedido")->num_rows + $conexion->mysqli->query("SELECT * FROM bulto_temporal WHERE id_pedido=$pedido->id_pedido")->num_rows;
                                        $finalizado = $pedido->estado_pedido==1 || $pedido->estado_pedido==2? true: false;
                                        $pagado = $pedido->estado_pedido==2? true: false;
                                    ?>
                                    <tr>
                                        <td><?=$pedido->id_pedido?> </td>
                                        <td>
                                            <?=$pedido->nombres_datos_contacto?> <?=$pedido->apellidos_datos_contacto?>
                                        </td>
                                        <td>
                                            <?=$pedido->telefono_datos_contacto?>
                                        </td>
                                        <td>
                                            <?=$pedido->email_datos_contacto?>
                                        </td>
                                        <td>
                                            <?=date("d-m-Y H:i:s", $pedido->timestamp_pedido)?>
                                        </td>
                                        <td><?=$cantidad_bultos?></td>
                                        <td><?=$cantidad_objetados?></td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-icon btn-default" data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="<?=$resultado = $finalizado? 'Pedido a la espera de pago' : 'Aún no es posible procesar el pago';?>"><i class="fas fa-<?=$resultado = $finalizado? 'check' : 'times';?>"></i></a>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-icon btn-default" data-toggle="tooltip" data-placement="top" title="" data-html="true" data-original-title="<?=$resultado = $pagado? 'Pedido pagado' : 'Pedido no pagado';?>"><i class="fas fa-<?=$resultado = $pagado? 'check' : 'times';?>"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <!-- </div>
        </div> -->

        <?php
        include_once('../include/footer.php')
        ?>

    </body>
</html>