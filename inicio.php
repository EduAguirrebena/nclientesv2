<?php 
    if(!isset($_SESSION['cliente'])):
        header("Location: index.php");
    endif;

    $id_cliente = $_SESSION['cliente']->id_cliente;

    require_once('ws/bd/dbconn.php');
    $conexion = new bd();
    $conexion->conectar();

?>


<!DOCTYPE html>
<html lang="en">
    <?php
        include_once('../nclientesv2/include/head.php');
    ?>



<body>
    <div id="app">
        <!-- SideBar -->
        <?php
            include_once('../nclientesv2/include/sidebar.php');
        ?>
       
        <div id="main"  class="layout-navbar">

            <?php
                include_once('./include/topbar.php');
            ?>
       

            <div class="page-content" style="color:3e3e3f;">
                <div class="resumen-envios row mt-2">
                    <div class="row">
                        <h4 style="color:#3e3e3f">Mis envíos</h4>
                    </div>
                    <div class="masteresume row">
                        
                            <div class="col-lg-3 col-sm-6 col-md-6 card colresume">
                                <div class="row">
                                    <a href=""><span class="envtitle"><h5>Envíos</h5></span></a>
                                </div>
                                <div class="row dataresenv">
                                    <div class="col-lg-6 col-md-6 col-sm-12 co-12 envresitems">
                                        <i class="fa-solid fa-truck"></i>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 co-12 envresitems"> <h4>14</h4></div>
                                </div>
                             </div>
                       
                                
                            
                            <div class="col-lg-3 col-sm-6 col-md-6 card colresume">
                                <div class="row">
                                    <a href=""><span class="envtitle"><h5>Entregados</h5></span></a>
                                </div>
                                <div class="row dataresenv">
                                    <div class="col-lg-6 col-md-6 col-sm-12 co-12 envresitems"> <i class="fa-solid fa-check"></i></div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 co-12 envresitems"> <h4>14</h4></div>
                                </div>
                                    
                                    
                            </div>
                            <div class="col-lg-3 col-sm-6 col-md-6 card colresume">
                                <div class="row">
                                    <a href=""><span class="envtitle"><h5>Pendientes</h5></span></a>
                                </div>
                                <div class="row dataresenv">
                                    <div class="col-lg-6 col-md-6 col-sm-12 co-12 envresitems"> 
                                        <i class="fa-regular fa-clock"></i>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 co-12 envresitems">
                                        <h4>14</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-3">
                                <div class="row">
                                    <a href=""><span class="envtitle"><h5>Envíos</h5></span></a>
                                </div>
                                <div class="row dataresenv">
                                    <div class="col-6"> <i class="fa-solid fa-truck" style="font-size: 60px;"></i></div>
                                    <div class="col-6"> <h4>14</h4></div>
                                </div>
                            </div> -->
                        </div>
                </div>
                <section class="row imgrowmenu" >
                    <div class="col-12 col-lg-12">
                        <div class="row ">

                            <div class="singleimgmenu col-lg-3 col-sm-6 col-md-6">
                                <a href="./seleccionBultos.php">
                                    <div class="card" style="height: 200px; overflow-y: auto">
                                            <div class="card-body px-3 py-4-5" id="imgmenu">
                                                <div class="row " >
                                                    <div class="col-md-4" id="cardicon">
                                                        <div class="stats-icon green">
                                                            <i class="fa-solid fa-paper-plane"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 menutxt">
                                                        <h4 class="font-semibold"> Nuevo Envío </h4>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </a>
                            </div>

                            <div class="singleimgmenu col-lg-3 col-sm-6 col-md-6">
                                <a href="Bodegas.php">
                                    <div class="card" style="height: 200px; overflow-y: auto">
                                        <div class="card-body"  id="imgmenu">
                                            <div class="row">
                                                <div class="col-md-4" id="cardicon">
                                                    <div class="stats-icon green">
                                                        <i class="fa-solid fa-warehouse"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 menutxt">
                                                    <h4 class="font-semibold">Mis direcciones</h3>
                                                </div>
                                            </div>
                                            <div class="col-12" style="text-align: center; float:inline-end">
                                                <p>(Lugar donde iremos a retirar)</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="singleimgmenu col-lg-3 col-sm-6 col-md-6">
                                <a href="PedidosRealizados.php">
                                    <div class="card" style="height: 200px; overflow-y: auto">
                                        <div class="card-body px-3 py-4-5" id="imgmenu">
                                            <div class="row">
                                                <div class="col-md-4 "id="cardicon">
                                                    <div class="stats-icon green">
                                                        <i class="fa-solid fa-box"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 menutxt">
                                                    <h4 class="font-semibold">Mis Envíos</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="singleimgmenu col-lg-3 col-sm-6 col-md-6">
                                <a href="misDatos.php">
                                    <div class="card" style="height: 200px; overflow-y: auto">
                                        <div class="card-body px-3 py-4-5" id="imgmenu">
                                            <div class="row">
                                                <div class="col-md-4" id="cardicon">
                                                    <div class="stats-icon green">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 menutxt">
                                                    <h6 class=" font-semibold">Mis Datos </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- <div class="singleimgmenu col-lg-4 col-sm-6 col-md-6">
                                <div class="card">
                                    <a href="datosComerciales.php">
                                        <div class="card-body px-3 py-4-5" id="imgmenu">
                                            <div class="row">
                                                <div class="col-md-4" id="cardicon">
                                                    <div class="stats-icon green">
                                                        <i class="fa-solid fa-file-invoice"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 menutxt">
                                                    <h6 class=" font-semibold">Datos Facturacion</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div> -->
                           
                        </div>
                        
                    </div>
                </section>
            </div>

            <?php
                include_once('../nclientesv2/include/footer.php')
            ?>
           

<!-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> -->

</body>
<script>
    $(document).ready(function(e){
        $(".singleimgmenu").click(function(e){
            e.preventDefault();
            var url = $(this).attr('data-url');
            window.location.href = url;
        })
    })
</script>
</html>