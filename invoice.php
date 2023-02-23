<?php
    session_start();
    require_once('./ws/bd/dbconn.php');
    $conn = new bd();
    $conn->conectar();
    $id_pedido = $_GET['id_pedido'];

    $id_cliente = $_SESSION['cliente']->id_cliente;

    $qnomcli = "Select nombres_datos_contacto as nombre, apellidos_datos_contacto as apellido,
                rut_datos_contacto as rut, telefono_datos_contacto as telefono, email_datos_contacto as correo from 
                datos_contacto where id_cliente =".$id_cliente;

    if($resclientdata = $conn ->mysqli->query($qnomcli) )
    {
        while($datacliente = $resclientdata->fetch_object()){
            $datoscliente [] = $datacliente; 
        }
    }


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
            <div class="container mt-5 mb-3">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="d-flex flex-row p-2"> <img src="https://i.imgur.com/vzlPPh3.png" width="48">
                                <div class="d-flex flex-column"> <span class="font-weight-bold">Tax Invoice</span> <small>INV-001</small> </div>
                            </div>
                            <hr>
                            <div class="table-responsive p-2">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr class="add">
                                            <td>Para</td>
                                            <td>De</td>
                                        </tr>
                                        <tr class="content">
                                        <td class="font-weight-bold">Google <br>
                                            <?php
                                                foreach($datacliente as $dc):
                                            ?>
                                            <?=$dc->nombre." ".$dc->apellido?> 
                                            <br><?=$dc->rut?></td>
                                            <?php
                                                endforeach;
                                            ?>
                                            <td class="font-weight-bold">Spread <br> Attn: John Right Polymont <br> USA</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <div class="products p-2">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr class="add">
                                            <td>Description</td>
                                            <td>Days</td>
                                            <td>Price</td>
                                            <td class="text-center">Total</td>
                                        </tr>
                                        <tr class="content">
                                            <td>Website Redesign</td>
                                            <td>15</td>
                                            <td>$1,500</td>
                                            <td class="text-center">$22,500</td>
                                        </tr>
                                        <tr class="content">
                                            <td>Logo & Identity</td>
                                            <td>10</td>
                                            <td>$1,500</td>
                                            <td class="text-center">$15,000</td>
                                        </tr>
                                        <tr class="content">
                                            <td>Marketing Collateral</td>
                                            <td>3</td>
                                            <td>$1,500</td>
                                            <td class="text-center">$4,500</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <div class="products p-2">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr class="add">
                                            <td></td>
                                            <td>Subtotal</td>
                                            <td>GST(10%)</td>
                                            <td class="text-center">Total</td>
                                        </tr>
                                        <tr class="content">
                                            <td></td>
                                            <td>$40,000</td>
                                            <td>2,500</td>
                                            <td class="text-center">$42,500</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <div class="address p-2">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr class="add">
                                            <td>Bank Details</td>
                                        </tr>
                                        <tr class="content">
                                            <td> Bank Name : ADS BANK <br> Swift Code : ADS1234Q <br> Account Holder : Jelly Pepper <br> Account Number : 5454542WQR <br> </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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