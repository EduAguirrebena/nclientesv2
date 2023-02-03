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
                            <input type="search" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
                        </div>
                        <div class="card-body" id="tablepr">
                            <table class="table table-striped" id="myTable">
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
                                                        <button
                                                            class="btn btn-primary"
                                                            type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapseExample"
                                                            aria-expanded="false"
                                                            aria-controls="collapseExample"
                                                        >
                                                            Button with data-bs-target
                                                        </button>
                                                        </p>
                                                        
                                                    </td>
                                                    <div class="collapse" id="collapseExample">
                                                        Some placeholder content for the collapse component. This
                                                        panel is hidden by default but revealed when the user
                                                        activates the relevant trigger.
                                                        </div>
                                                </tr>

                                               





                                <?php
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
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
</body>

</html>