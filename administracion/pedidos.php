<?php 
session_start();
if(!isset($_SESSION['cliente'])):
    header("Location: ../index.php");
endif;

// $id_cliente = $_SESSION['cliente']->id_cliente;

// if($id_cliente!=3 && $id_cliente!=1) { 
//     echo $id_cliente;
//     exit();
// }

require_once('../ws/bd/dbconn.php');
$conexion = new bd();
$conexion->conectar();

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
                            <table class="table" style="max-width: 100%;">
                                <tr>
                                    <th>hola</th>
                                </tr>
                                <tr>
                                    <td>segundo</td>
                                </tr>
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