<?php
    session_start();
    include('ws/bd/dbconn.php');

    $id_cliente = $_SESSION['cliente']->id_cliente;
    $conn = new bd();

    $conn -> conectar();

    $query='Select Nombre_region as nombre,id_region as id from region';


    $querybodega =  'SELECT bo.nombre_bodega as nombre,
                            bo.calle_bodega as calle, 
                            bo.numero_bodega as numero,
                            bo.principal_bodega as principal, 
                            co.nombre_comuna as comuna,
                            re.nombre_region as region
                        FROM bodega bo
                        inner join comuna co on co.id_comuna = bo.id_comuna
                        inner join provincia pro on pro.id_provincia = co.id_provincia
                        inner join region re on re.id_region = pro.id_region
                        where bo.id_cliente = '.$id_cliente;



    if($res = $conn->mysqli->query($query))
    {
        $comunas = array();
        
        while($datares = $res ->fetch_object())
        {
            $comunas [] = $datares;
        }
    }
    else{
        echo $conn->mysqli->error;
    }


    if($resbod = $conn->mysqli->query($querybodega))
    {
        $bodegas = array();
        
        while($databod = $resbod ->fetch_object())
        {
            $bodegas [] = $databod;
        }
    }
    else{
        echo $conn->mysqli->error;
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
        
        
        <div id="main" class="layout-navbar">
       
            <?php
                include_once('./include/topbar.php');
            ?>

            <div class="page-heading">
                <div class="row">
                    <div class="col-sm-9">
                        <h3>Bodegas || Spread</h3>
                    </div>
                    <div class="col-sm-3">
                    <!-- Button trigger for Crear form modal -->
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                        data-bs-target="#inlineForm">
                        Agregar bodega
                    </button>
                </div>
            </div>
            <div class="page-content">

                <div class="resumen-bodegas">
                    <div class="row">
                                <?php
                                    foreach($bodegas as $bodega):
                                    $main = $bodega->principal;
                                ?>
                                    <div class="card_bodegas col-lg-3 col-md-4 col-sm-6 col-12" >
                                            <div class="card bodega card_bodegas">
                                                <div class="card-content" style="justify-content: center;">
                                                    <div class="card-body" id="cardbodywarehouse" >
                                                        <div class="row">
                                                            <h4 class="card-title col-10"><?php echo $bodega->nombre?></h4>
                                                        </div>
                                                        <p style="flex-direction: column-reverse;"><?php echo $bodega->calle?></p>
                                                        <p class="card-text">
                                                        <?php echo $bodega->comuna.', '.$bodega->region?>
                                                        </p>
                                                        <div class="row" style="justify-content: center;">
                                                        </div>
                                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModForm"
                                                                        data-bs-toggle="tooltip" title="Modificar">
                                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                                </button>
                                                            
                                                                <button type="button" class="btn btn-danger"  data-bs-target="#danger"data-bs-toggle="modal" data-bs-toggle="tooltip" title="Eliminar" 
                                                                   >
                                                                    <i class="fa-solid fa-trash"></i>
                                                                </button>
                                                        
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                    </div>
                                <?php
                                        endforeach;                                                                    
                                ?>
                        </div>

                </div>
                    
            </div>

            
        </div>
       



                <!--Danger theme Modal -->
                <div class="modal fade text-left" id="danger" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel120" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                        role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-danger">
                                <h5 class="modal-title white" id="myModalLabel120">Eliminar Punto de Retiro
                                </h5>
                                <button type="button" class="close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                Desea eliminar el punto de retiro (Datos puntos de retiro)
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary"
                                    data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                                <button type="button" class="btn btn-danger ml-1"
                                    data-bs-dismiss="modal">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Accept</span>
                                </button>
                            </div>
                        </div>
                 </div>
                </div>
                <!--Crear Bodega form Modal -->
                <div class="modal fade text-left" id="inlineForm"  tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel33" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                        role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel33">Crear Bodega</h4>
                                <button type="button" class="close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <form action="#">
                                <div class="modal-body">
                                    <label>Nombre </label>
                                    <div class="form-group">
                                        <input type="text" placeholder="Nombre"
                                            class="form-control" id="bodnombre" required>
                                    </div>
                                    <label>Calle </label>
                                    <div class="form-group">
                                        <input type="text" placeholder="Dirección"
                                            class="form-control" id="boddireccion" required>
                                    </div>
                                    <label>Número </label>
                                    <div class="form-group">
                                        <input type="text" placeholder="Número"
                                            class="form-control" id="bodnumero" required>
                                    </div>
                                    <label>Comuna</label> </label>
                                    <label for="select_regioncre">Region</label> </label>
                                    <div class="input-group mb-3">
                                        <label class="input-group-text"
                                            for="select_regioncre">Comunas</label>
                                        <select class="form-select" name="select_regioncre" id="select_regioncre" required>
                                            <option value=""></option>
                                                <?php 
                                                    foreach($comunas as $com)
                                                    {
                                                        echo '<option value="'.$com->id.'">'.$com->nombre.'</option>';
                                                    }
                                                ?>  
                                        </select>
                                    </div>
                                    <label for="select_comunacre">Comuna</label> </label>
                                    <div class="input-group mb-3">
                                        <label class="input-group-text"
                                            for="select_comunacre">Comunas</label>
                                            <select class="form-select" name="select_comunacre" id="select_comunacre" required>
                                                <option value=""></option>
                                            </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-secondary"
                                        data-bs-dismiss="modal">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Cancelar</span>
                                    </button>
                                    <input type="submit" value="Agregar" class="submit btn btn-primary ml-1"
                                    >
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block"></span>
                                </input>
                                </div>
                            </form>
                    </div>
                </div>


            
            </div>
            <!--Modificar Bodega form Modal -->
            <form action="" class="modal fade text-left" id="ModForm"  tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel33" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                    role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel33">Modificar Bodega</h4>
                            <button type="button" class="close" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div id="formmodificar">
                            <div class="modal-body">
                                <label for="nombre">Nombre </label>
                                <div class="form-group">
                                    <input type="text" placeholder="Nombre"
                                        class="form-control" name="nombre" id="nombre" required>
                                </div>
                                <label for="calle">Calle </label>
                                <div class="form-group">
                                    <input type="text" placeholder="Dirección"
                                        class="form-control" name="calle" id="calle" required>
                                </div>
                                <label for="numero">Número </label>
                                <div class="form-group">
                                    <input type="text" placeholder="Número"
                                        class="form-control" name="numero" id="numero" required>
                                </div>
                                <label for="select_regionmod">Region</label> </label>
                                <div class="input-group mb-3">
                                    <label class="input-group-text"
                                        for="select_regionmod">Region</label>
                                    <select class="form-select" name="select_regionmod" id="select_regionmod" required>
                                        <option value=""></option>
                                            <?php 
                                                foreach($comunas as $com)
                                                {
                                                    echo '<option value="'.$com->id.'">'.$com->nombre.'</option>';
                                                }
                                            ?>  
                                    </select>
                                </div>
                                <label for="select_comunamod">Comuna</label> </label>
                                <div class="input-group mb-3">
                                    <label class="input-group-text"
                                        for="select_comunamod">Comuna</label>
                                        <select class="form-select" name="select_comunamod" id="select_comunamod" required>
                                            <option value=""></option>
                                        </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary"
                                    data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Cancelar</span>
                                </button>
                                <input type="submit" value="Modificar"  class="submit btn btn-primary ml-1"
                                    >
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block"></span>
                                </input>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
   <!-- Footer contiene div de main app div -->
   <?php
        include_once('../nclientesv2/include/footer.php')
    ?>
    <script src="assets/js/jquery-validation/jquery.validate.js"></script>


</body>
<script>

    $("#crearBodega").click(function(){
            try{
                let vdir = document.getElementById('boddireccion').value
                let vnumero = document.getElementById('bodnumero').value
                let vnombre = document.getElementById('bodnumero').value
                let vcomuna = document.getElementById('select_comunaccre').value
                let vregion = document.getElementById('select_regioncre').value

                let dataajax = {direccion : vdir,
                                numero: vnumero,
                                nombre : vnombre,
                                comuna : vcomuna,
                                region: vregion};

                        $.ajax({
                        url: "ws/bodega/newBodega.php",
                        type: "POST",
                        data: JSON.stringify(dataajax),
                        success:function(resp){
                            console.log(resp)
                            return false
                            
                            // if(resp==="error"){
                            //     console.log("creado");
                            //     return false; 
                            // }
                            // else{
                            //     return false;
                            // }
                        }
                    })
            }
            catch(error){
                console.log(error);
            }    
    })


        $("#select_regioncre").on('change',function(){
            var idregion = this.value;
            var comuna = document.getElementById("select_comunacre");
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
                                    let select = document.getElementById("select_comunacre");
                                    select.options[select.options.length] = new Option(value.nombre,value.id);
                                })
                            },
                                error: function(data){
                            }
            })
        })

        $("#select_regionmod").on('change',function(){
            var idregion = this.value;
            var comuna = document.getElementById("select_comunamod");
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
                                    let select = document.getElementById("select_comunamod");
                                    select.options[select.options.length] = new Option(value.nombre);
                                })
                                
                            },
                                error: function(data){
                            }
            })
        })

        ().ready(function(){

            $("#ModForm").validate(
                {
                rules:{
                    nombre:{
                        required : true
                    },
                    calle:{
                        required: true,
                        minlength: 4
                    },
                    numero: {
                        required:true
                    },
                    select_regioncli:{
                        required:true
                    },
                    select_comunacli:{
                        required:true
                    }
                },
                messages:{
                    nombre:{
                        required : "Debe ingresa un Nombre para el punro de retiro"
                    },
                    calle:{
                        required: "Debe ingresar la dirección del punto de retiro",
                        minlength: "Debe tener al menos 4 caracteres"
                    },
                    numero: {
                        required:"Debe ingresar la numeración de la dirección"
                    },
                    select_regioncli:{
                        required:"Seleccione una región"
                    },
                    select_comunacli:{
                        required:"Seleccione una comuna"
                    }
                }
            })
        })

        
</script>
</html>