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

            <div class="page-heading">
                <h3>Seleccion Bultos || Spread</h3>
            </div>
            <div class="pagecontent">
                <div class="container">
                    <div class="row d-flex">
                        <div class="row centerrows">
                        <div class="col-6 col-lg-4 col-md-6" id=bulto-card>
                                    <div class="card">
                                        <a href="unitario.php">
                                            <div class="card-body px-3 py-4-5" id="imgmenu">
                                                <div class="row">
                                                    <div class="col-md-4 "id="cardicon">
                                                        <div class="stats-icon green">
                                                            <i class="fa-solid fa-box"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 menutxt">
                                                        <h6 class="font-semibold">1 pedido</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                        </div>
                        <div class="row centerrows">
                        <div class="col-6 col-lg-4 col-md-6" id=bulto-card>
                                    <div class="card">
                                        <a href="multibulto.php">
                                            <div class="card-body px-3 py-4-5" id="imgmenu">
                                                <div class="row">
                                                    <div class="col-md-4 "id="cardicon">
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
                        </div>
                        <div class="row centerrows">
                        <div class="col-6 col-lg-4 col-md-6" id=bulto-card>
                                    <div class="card">
                                        <a href="cargamasiva.php">
                                            <div class="card-body px-3 py-4-5" id="imgmenu">
                                                <div class="row">
                                                    <div class="col-md-4 "id="cardicon">
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
                </div>
            </div>
</div>
<?php
 require_once('include/footer.php')
?>
</body>
</html>