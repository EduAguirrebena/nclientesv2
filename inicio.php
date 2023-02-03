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
        include_once('../nclientesv2/include/head.php')
    ?>



<body>
    <div id="app">
        <!-- SideBar -->
        <?php
            include_once('../nclientesv2/include/sidebar.php');
        ?>
        

        
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>Inicio || Spread</h3>
                <h1> <?php print_r($id_cliente); ?> </h1>
            </div>
            <div class="page-content">
                
                <section class="row">
                    <div class="col-12 col-lg-12">
                        <div class="row">
                            <div class="col-6 col-lg-4 col-md-6">
                                <div class="card">
                                    <a  href="querytest.php">
                                        <div class="card-body px-3 py-4-5" id="imgmenu">
                                            <div class="row " >
                                                <div class="col-md-4" id="cardicon">
                                                    <div class="stats-icon green">
                                                        <i class="fa-solid fa-paper-plane"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 menutxt">
                                                    <h6 class="font-semibold"> Enviar </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-6 col-lg-4 col-md-6">
                                <div class="card">
                                    <a href="Bodegas.php">
                                        <div class="card-body px-3 py-4-5 "  id="imgmenu">
                                            <div class="row">
                                                <div class="col-md-4" id="cardicon">
                                                    <div class="stats-icon green">
                                                        <i class="fa-solid fa-warehouse"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 menutxt">
                                                    <h6 class="font-semibold">Bodegas</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    
                                </div>
                            </div>
                            <div class="col-6 col-lg-4 col-md-6">
                                <div class="card">
                                    <a href="PedidosRealizados.php">
                                        <div class="card-body px-3 py-4-5" id="imgmenu">
                                            <div class="row">
                                                <div class="col-md-4 "id="cardicon">
                                                    <div class="stats-icon green">
                                                        <i class="fa-solid fa-box"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 menutxt">
                                                    <h6 class="font-semibold">Pedidos Realizados</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-6 col-lg-4 col-md-6">
                                <div class="card">
                                    <a href="misDatos.php">
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
                                    </a>
                                </div>
                            </div>
                            <div class="col-6 col-lg-4 col-md-6">
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
                            </div>
                            <div class="col-6 col-lg-4 col-md-6">
                                <div class="card">
                                    <a href="">
                                        <div class="card-body px-3 py-4-5" id="imgmenu">
                                            <div class="row">
                                                <div class="col-md-4" id="cardicon">
                                                    <div class="stats-icon green">
                                                        <i class="fa-solid fa-boxes-stacked"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 menutxt">
                                                    <h6 class=" font-semibold">Pedidos Pendientes</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Envios</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="chart-profile-visit"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <!-- <div class="col-12 col-lg-3">
                        <div class="card">
                            <div class="card-header">
                                <h4>Resumen Comunas</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-visitors-profile"></div>
                            </div>
                        </div>
                    </div> -->
                </section>
            </div>

            <?php
                include_once('../nclientesv2/include/footer.php')
            ?>
</body>

</html>