<?php
 session_start();
?>

<!DOCTYPE html>
<html lang="en">
<?php 
    require_once('include/head.php');
?>
<body>
    <?php 
        include_once('include/sidebar.php');
    ?>


<div id="main" class="layout-navbar">
            <?php
                include_once('./include/topbar.php');
            ?>

            <!-- <div class="page-heading">
                <h3></h3>
            </div> -->
            <div class="page-content">
                    <div class="resumen-envios row mt-2">
                        <div class="row">
                            <h4 style="color:#3e3e3f" class="mb-2">Seleccion Bultos || Spread</h4>
                        </div>
                        <div class="col-lg-4 col-md-12 mt-2 mb-2">
                            <div class="card">
                                <a href="./unitario.php">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div class="col-4 d-flex justify-content-center">
                                                <div class="stats-icon green">
                                                    <i class="fa-solid fa-box"></i>
                                                </div>
                                            </div>
                                            <div class="col-8 menutxt">
                                                <h6 class="font-semibold">1 pedido</h6>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 mt-2 mb-2">
                            <div class="card">
                                <a href="./multibulto.php">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4 d-flex justify-content-center">
                                                <div class="stats-icon green">
                                                <i class="fa-solid fa-boxes-stacked"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 menutxt">
                                                <h6 class="font-semibold">2 a 10 bultos</h6>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 mt-2 mb-2">
                            <div class="card">
                                <a href="./cargamasiva.php">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4 d-flex justify-content-center">
                                                <div class="stats-icon green">
                                                    <i class="fa-solid fa-list"></i>                                                        
                                                </div>
                                            </div>
                                            <div class="col-md-8 menutxt">
                                                <h6 href="" class="font-semibold">Carga masiva</h6>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                            
                    </div>
            </div>
<?php
 require_once('include/footer.php')
?>
</div>
</body>
</html>