<?php
    session_start();

    require_once('./ws/bd/dbconn.php');
    $conn = new bd();
    $conn ->conectar();

    $id_pedido = $_GET['id_pedido'];

    
    $querybultos = "Select * from bulto where id_pedido = $id_pedido and Deleted = 0";

    if($bultoperpedido = $conn->mysqli->query($querybultos)){
        while($resbultos = $bultoperpedido->fetch_object()){
            $bultos[] = $resbultos;
        }
    }
    $conn ->desconectar();

    function func_suma(){
        $id_pedido = $_GET['id_pedido'];
        $conbd = new bd();
        $conbd->conectar();
        $queryusm = "SELECT sum(precio_bulto) as precio from bulto where id_pedido= $id_pedido";
        if($sumapedido = $conbd->mysqli->query($queryusm)){
            while($suma = $sumapedido->fetch_object()){
                $total[] = $suma;
            }
            foreach($total as $totales){
                return $totales->precio;
            }
           
        }
    }


    function getRegiones(){
        $conbd = new bd();
        $conbd->conectar();
        $query='Select Nombre_region as nombre,id_region as id from region';
        if($regres = $conbd->mysqli->query($query)){
            while($dataregiones = $regres->fetch_object()){
                $regiones[] = $dataregiones;
            }
            return $regiones;
        }
    }
    

?>
<!DOCTYPE html>
<html lang="en">
<?php   

        require_once('./include/head.php');
?>
<body>
    <div id="app">
        <?php
            require_once('./include/sidebar.php');
        ?>
        <div id="main" class="layout-navbar">
            <?php
                require_once('./include/topbar.php');
        ?>

        <div class="confirmar_pedido" >
            <div class="confirmar_pedidohead">
                <h4>Resumen de Pedido</h4>
            </div>
            <div class="confirmar_pedidoBody" id="reloadiv">
                <table class="table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col">Destinatario</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($bultos as $bulto):      
                        ?>
                            <tr>
                                <td class="id_bulto" style="display: none;"><?=$bulto->id_bulto?></td>
                                <td><?=$bulto->nombre_bulto?></td>
                                <td><?=$bulto->direccion_bulto?></td>
                                <td><?=$bulto->precio_bulto?></td>
                                <td style="text-align: end; max-width: 80px;">
                                    <button class="btn btn-warning editbulto" id="" data-bs-toggle="modal" data-bs-target="#xlarge" data-bs-toggle="tooltip" title="Modificar">
                                        <i class="fa-solid fa-pen-to-square" ></i>
                                    </button>
                                    <button  class="btn btn-danger" data-bs-toggle="tooltip" title="Eliminar">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php
                            endforeach;   
                        ?>
                        <tr>
                            <?php
                                $suma = func_suma();
                            ?> 
                            <td></td>
                            <td style="text-align: end;">Total</td>
                            <td><?=$suma?></td>
                            <td>
                            </td>
                        </tr>
                             
                </table>
            </div>
            <div style="width: 100%; display:flex; justify-content: end;">
                <button onclick="updateDiv()" class="btn btn-success" data-bs-toggle="tooltip"  title="Continuar" >
                                <i class="fa-solid fa-file-invoice"></i>
                                <p>Procesar Pago</p>
                </button>
            </div>
            
        </div>
            <!-- MODAL LARGE-->
           
                <div class="modal fade text-left w-100" id="xlarge" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel16" aria-hidden="true" style="padding: 60px; border-radius: 50px;">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"
                        role="document">
                        <div class="modal-content" style="padding: 0px 50px;">
                            <form class="form form" id="toValdiateBulto">
                                <div class="form-body">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel33">Modificar Bodega</h4>
                                        <button type="button" class="close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                        <div class="form-group">
                                            <label for="gg">Nombre</label>
                                            <input type="text" id="nombredestinatario" class="form-control" name="nombredestinatario" placeholder="Nombre Destinatario"/>
                                        </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="contact">Teléfono</label >
                                                <input type="number" id="numtel" class="form-control" name="numtel" placeholder="Teléfono"/>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                        <div class="form-group">
                                            <label for="email-id">Dirección</label>
                                            <input type="text" id="dir" class="form-control" name="dir" placeholder="Dirección"/>
                                        </div>
                                        </div>
                                        
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="Correo">Correo </label>
                                                <input type="email" id="correo" class="form-control" name="correo" placeholder="Correo"/>
                                            </div>
                                        </div>
                                        
                                        <div class="col-6">
                                            <label for="select_region">Región </label>
                                            <select name="select_region" class="form-select" id="select_region">
                                                <option value=""></option>
                                                <?php   
                                                    $reg = getRegiones();
                                                    foreach($reg as $r):
                                                ?>
                                                <option value="<?php echo $r->id?>"><?php echo $r->nombre?></option>
                                                <?php
                                                    endforeach;
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label for="Comuna">Comuna</label>
                                            <select name="select_comuna" class="form-select" id="select_comuna">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="Item">Item a enviar </label>
                                                <input type="text" id="item" class="form-control" name="item" placeholder="Item"/>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="Costo">Costo item </label>
                                                <input type="text" id="cost" class="form-control" name="cost" placeholder="Precio Item"/>
                                            </div>
                                        </div>
                                        <div class="col-3" style="text-align: center;">
                                            <div class="form-group">
                                            <label for="Costo"> Tipo envío </label>
                                                <select name="select_type" class="form-select" id="select_type" value="">
                                                    <option value="1"></option>
                                                    <option value="1">mini</option>
                                                    <option value="2">medio</option>
                                                </select>
                                            </div>
                                            <label id="tipoenvio">Rango de peso</label>
                                        </div>
                                        <div class="col-4 justify-content-start">
                                            <button data-bs-toggle="modal" data-bs-target="#xlarge" id="closemodal" type="submit" class="btn btn-primary me-1 mb-1 col-12"> Modificar Bulto </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        

                        </div>
                    </div>
                </div>
            
            
    <?php
        include_once('./include/footer.php');
    ?>
</body>


<script>
    var idbulto = "";

    
    $(".editbulto").click(function(){

        $("#xlarge input").val("");
        $("#xlarge select").val("");
        // $("#xlarge").find('input').val("");
        // $("#xlarge").find('input').val("");
        var idbulto = $(this).closest('tr').find(".id_bulto").text();
         alert(idbulto);
      
        $.ajax({
            url: "ws/bulto/getbultobyId.php",
            type: "POST",
            dataType: 'json',
            data: {
                "id_bulto": idbulto
            },
            success:function(resp){
                console.log(resp);
            $.each(resp,function(key,value){
                    console.log(value.nombre);
                    // document.getElementById("nombredestinatario").innerHTML = ""+value.nombre+""
                    $("#xlarge").find('input[name="nombredestinatario"]').val(value.nombre);
                    $("#xlarge").find('input[name="numtel"]').val(parseInt(value.telefono));
                    $("#xlarge").find('input[name="dir"]').val(value.direccion);
                    $("#xlarge").find('input[name="correo"]').val(value.correo);
                    $("#xlarge").find('select[name="select_region"]').val(value.region);
                    $("#xlarge").find('select[name="select_comuna"]').val(value.comuna);
                    $("#xlarge").find('input[name="item"]').val(value.item);
                    $("#xlarge").find('input[name="cost"]').val(value.valor);
                    $("#xlarge").find('input[name="select_type"]').val(value.servicio);
                })
             }
        })
    })


    $("#select_region").on('change',function(){
    var idregion = this.value;
    var comuna = document.getElementById("select_comuna");
    comuna.options = new Option("");
    comuna.options.length = 0;
    $.ajax({
                    type: "POST",
                    url: "ws/pedidos/getComunaByRegion.php",
                    dataType: 'json',
                    data: {
                        "idregion" : idregion
                    },
                    success: function(data) {
                        console.log(data);

                        $.each(data, function (key, value){
                            let select = document.getElementById("select_comuna");
                            select.options[select.options.length] = new Option(value.nombre,value.id);
                        })
                        
                    },
                        error: function(data){
                    }
    })
})


    function updateDiv()
    { 
        $("#reloadiv").load(window.location.href +" #reloadiv");
    }
</script>


</html>