<?php
    session_start();
    include('ws/bd/dbconn.php');

    $id_cliente = $_SESSION['cliente']->id_cliente;
    $conn = new bd();

    $conn -> conectar();

    $query='Select Nombre_region as nombre,id_region as id from region';

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

    

?>
<!DOCTYPE html>
<html lang="en">
 <?php
    require_once('include/head.php');
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
                <h3>Carga Unitaria || Spread</h3>
                <h1> <?php print_r($id_cliente); ?> </h1>
            </div>
            <div class="page-content">
                    <section id="basic-vertical-layouts">
                        <div class="row match-height">
                            <div class="col-md-12 col-12">
                                <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Formulario de envío(Datos destinatario)</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                    <form class="form form-vertical" id="toValdiateBulto">
                                        <div class="form-body">
                                        <div class="row">
                                            <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Nombre</label>
                                                <input type="text" id="fname " class="form-control" name="fname" placeholder="Nombre destinatario"/>
                                            </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="contact">Teléfono</label >
                                                    <input id="numtel" class="form-control" name="numtel" placeholder="Teléfono"/>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Dirección</label>
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
                                                <label for="Comuna">Comuna </label>
                                                <select name="select_comuna" class="form-select" id="select_comuna">
                                                    <option value=""></option>
                                                    <?php 
                                                    foreach($comunas as $com)
                                                    {
                                                        echo '<option value="'.$com->id.'">'.$com->nombre.'</option>';
                                                    }
                                                    ?>  
                                                </select>
                                            </div>
                                            <div class="col-6">
                                            <div class="form-group">
                                                <label for="Item">Item a enviar </label>
                                                <input type="text" id="item" class="form-control" name="item" placeholder="Item"/>
                                            </div>
                                            <div class="col-6">
                                            <div class="form-group">
                                                <label for="Costo">Costo item </label>
                                                <input type="text" id="cost" class="form-control" name="cost" placeholder="Precio Item"/>
                                            </div>
                                            <div class="col-6">
                                            <div class="form-group">
                                            <label for="Costo"> Tipo envío </label>
                                                <select name="select_type" class="form-select" id="select_type" value="">
                                                    <option value="mini">mini</option>
                                                    <option value="medium">medio</option>
                                                </select>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="submit btn btn-primary me-1 mb-1" value="Submit"> Enviar </button>
                                            </div>
                                        </div>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                        
                        </div>
                    </section> 
            </div>

            <?php
                include_once('../nclientesv2/include/footer.php')
            ?>

            <script src="assets/js/jquery-validation/jquery.validate.js"></script>

<script>

    // var select_box_element = document.querySelector('#select_box');

    // dselect(select_box_element, {
    //     search: true
    // });
$("#select_comuna").on('change',function(){
    var idregion = this.value;
    $.ajax({
                    type: "POST",
                    url: "ws/pedidos/getComunaByRegion.php",
                    data: {
                        "idregion" : idregion
                    },
                    success: function(data) {

                        console.log(utf8_decode.data );
                    },
                    error: function(data){
                    }
})})


    $().ready(function(){
        $('#toValdiateBulto').validate({
            rules:{
                fname:{
                    required :true,
                    minlength:4
                },
                dir:{
                    required :true,
                    minlength :8
                },
                numtel:{
                    required: true,
                    minlength:9
                },
                correo:{
                    required:true,
                    email:true
                },
                select_comuna:{
                    required:true
                },
                item:{
                    required : true
                },
                cost:{
                    required:true
                },
                select_type:{
                    required:true
                }
            },
            messages:{
                fname:{
                    required : "Debe ingresar un destinatario",
                    minlength : "El nombre debe tener al menos 4 caracteres"
                },
                dir:{
                    required :"Debe ingresar una direccion valida",
                    minlength :"la direccióndebe tener al menos 8 caracteres"
                },
                numtel:{
                    required: "Debe ingresar el télefono del destinatario",
                    minlength:"El teléfono debe tener al menos 9 números"
                },
                correo:{
                    required:"Debe ingresar un correo",
                    email:"Formato de correo no valido ej:'ejemplo@correo.com'"
                },
                select_comuna:{
                    required:"Debe ingresar la comuna de destino"
                },
                item:{
                    required : "Ingrese el objeto que se va a despachar"
                },
                cost:{
                    required:"Ingrese costo del Item a despachar"
                },
                select_type:{
                    required:"Debe Seleccionar el tipo de envío"
                }
            }       
        })

    })

</script>
    
    
</body>
<style>
    .error{
        color:red;
    }
    .form-select option{
        color:black;
    }
</style>
</html>

