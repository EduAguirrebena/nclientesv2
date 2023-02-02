<?php
    session_start();
    if(!isset($_SESSION['cliente']))
    {
        header("Location: index.php");
    }
    $id_cli = $_SESSION['cliente']->id_cliente;

    include_once('../Spread/ws/bd/dbconn.php');

    $conn = new bd();
    $conn->conectar();



    $query ='SELECT p.id_pedido,p.timestamp_pedido,b.nombre_bodega FROM pedido p
            INNER JOIN cliente c ON (p.id_cliente=c.id_cliente)
            INNER JOIN bodega b ON (p.id_bodega=b.id_bodega)
            WHERE c.id_cliente='. $id_cli .' AND p.estado_pedido>=2';

    $existe = false;
    if($res = $conn->mysqli->query($query)){
        $datapedido = array();
        
        while($datares = $res ->fetch_object())
        {
            $datapedido [] = $datares;
        }
        $size = sizeof($datapedido);
        $res -> close();
        $datapedido = (object)$datapedido;
        $existe = true;
       
        
    }
    else{
        echo $conn->mysqli->error;
        exit();
    }
    $suma=0;
    for ($i = 0; $i<=$size; $i ++){
        
    }
?>

<!DOCTYPE html>
<html lang="en">

<?php
    include_once('../Spread/include/head.php')
?>

<body>
    <div id="app">
        <!-- SideBar -->
        <?php
            include_once('../Spread/include/sidebar.php');
        ?>

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <div class="row">
                    <div class="col-sm-9">
                        <h3>Pedidos Realizados || Spread</h3>
                    </div>
                    
                    
                </div>
                
            </div>
            <div class="page-content">

                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            Simple Datatable
                        </div>
                        <div class="card-body" id="tablepr">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Teléfono</th>
                                        <th>Ciudad</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>


                                <?php
                                    $conn->conectar();
                                        if($existe):
                                            foreach($datapedido as $pedido):
                                                $req = "SELECT sum(precio_bulto)as precio from bulto where id_pedido =".$pedido->id_pedido.";";
                                                $restotal = mysqli_query($conn->mysqli ,$req);
                                                $row = mysqli_fetch_assoc ($restotal);
                                                $total = $row['precio'];
                                ?>
                                                <tr>
                                                    <td><span class="idPedido"><?=$pedido->id_pedido?></span></td>
                                                    <td><?=date('d/m/Y',$pedido->timestamp_pedido)?></td>
                                                    <td><?=date('H:i:s',$pedido->timestamp_pedido)?></td>
                                                    <td ><?=$total?></td>
                                                    <td>
                                                    <span class="badge bg-success btnSelect">por programar</span>
                                                    </td>
                                                </tr>
                                <?php
                                            endforeach;
                                        endif;                                
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>

            
        </div>
   <!-- Footer contiene div de main app div -->
   <?php
        include_once('../Spread/include/footer.php')
    ?>

    <!-- <script>
        $(document).ready(function(){

        $("#table1").on('click', '.btnSelect', function() {
        // get the current row
            var currentRow = $(this).closest("tr");

            var col1 = currentRow.find(".idPedido").html();
            
            console.log(col1);
         });
        });
    </script> -->
</body>

</html>