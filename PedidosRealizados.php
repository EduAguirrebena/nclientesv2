<?php
    session_start();
    if(!isset($_SESSION['cliente']))
    {
        header("Location: index.php");
    }
    $id_cli = $_SESSION['cliente']->id_cliente;

    include_once('../nclientesv2/ws/bd/dbconn.php');

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

            <div class="page-heading" style="position: relative !important; margin-top: 10px; margin-bottom: 15px;">
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
                            <input type="search" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
                        </div>
                        <div class="card-body" id="tablepr">
                            <table class="table table-striped" id="prtable">
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
                                    $index =0;
                                    $conn->conectar();
                                        if($existe):
                                            foreach($datapedido as $pedido):
                                                $req = "SELECT sum(precio_bulto)as precio from bulto where id_pedido =".$pedido->id_pedido.";";
                                                $restotal = mysqli_query($conn->mysqli ,$req);
                                                $row = mysqli_fetch_assoc ($restotal);
                                                $total = $row['precio'];
                                ?>
                                                <tr>
                                                    <td><span class="idpedido"><?=$pedido->id_pedido?></span></td>
                                                    <td><?=date('d/m/Y',$pedido->timestamp_pedido)?></td>
                                                    <td><?=date('H:i:s',$pedido->timestamp_pedido)?></td>
                                                    <td ><?=$total?></td>
                                                    <td>
                                                        <button
                                                            class="btnGetData btn btn-primary"
                                                            id="mybutton"
                                                            type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapseExample<?php echo $index;?>"
                                                            aria-expanded="false"
                                                            aria-controls="collapseExample">
                                                            resumen pedido
                                                        </button>

                                                        </p>
                                                        
                                                    </td>
                                                    <!-- <tr class="collapse" id="collapseExample<?php echo $index;?>">
                                                            <th class="collapse"  id="collapseExample<?php echo $index;?>">NOMBRE</th>
                                                            <th class="collapse" id="collapseExample<?php echo $index;?>">DIRECCION</th>
                                                            <th class="collapse" id="collapseExample<?php echo $index;?>">PRECIO</th>
                                                    </tr> -->
                                                   
                                                           
                                                    <tr id="collapseExample<?php echo $index;?>">

                                                            
                                                        <thead class="collapse expandible" id="collapseExample<?php echo $index;?> ">
                                                        



                                                        </thead>
                                                    </tr>
                                                    
                                                </tr>

                                               





                                <?php
                                                $index ++;
                                            endforeach;
                                        endif;                                
                                ?>
                                </tbody>
                            </table> 
                    </div>
                </section>
            </div>

            
        </div>
   <!-- Footer contiene div de main app div -->
   <?php
        include_once('../nclientesv2/include/footer.php')
    ?>

<script>
    $(document).ready(function(){
        

        $("#prtable").on('click', '.btnGetData', function() {
                   

          
            // get the current row
                    var currentRow = $(this).closest("tr");
                    var currentRow = $(this).closest("tr");
                    var exp = $(".expandible").attr('id');
                    var colId = currentRow.find(".idpedido").html();
                    var params = {
                        "columnid": colId
                    }
                    // alert(data);
                    $.ajax({
                        data:  params,
                        url:   'ws/pedidos/getBultoByPedido.php',
                        type:  'post',
                        success:  function (response) {
                                $("#"+exp).html(response);
                        }
                    });
                });
    });
</script>
</body>

</html>