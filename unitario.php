<?php
    session_start();
    include_once('ws/bd/dbconn.php');

    $id_cliente = $_SESSION['cliente']->id_cliente;
    $conn = new bd();

    $conn -> conectar();

    $query='Select Nombre_comuna as nombre from comuna';

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
                            <div class="col-md-6 col-12">
                                <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Formulario de envío(Datos destinatario)</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                    <form class="form form-vertical" id="toValdiateBulto">
                                        <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Nombre</label>
                                                <input type="text" id="fname " class="form-control" name="fname" placeholder="Nombre destinatario"/>
                                            </div>
                                            </div>
                                            <div class="col-12">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Dirección</label>
                                                <input type="text" id="dir" class="form-control" name="dir" placeholder="Dirección"/>
                                            </div>
                                            </div>
                                            <div class="col-12">
                                            <div class="form-group">
                                                <label for="contact-info-vertical">Teléfono</label >
                                                <input id="numtel" class="form-control" name="numtel" placeholder="Teléfono"/>
                                            </div>
                                            </div>
                                            <div class="col-12">
                                            <div class="form-group">
                                                <label for="Correo">Correo </label>
                                                <input type="email" id="correo" class="form-control" name="correo" placeholder="Correo"/>
                                            </div>
                                            
                                            <div class="col-12">
                                                <label for="Comuna">Comuna </label>
                                                <select name="select_box" class="form-select" id="select_comuna">
                                                    <option value=""></option>
                                                    <?php 
                                                    foreach($comunas as $com)
                                                    {
                                                        echo '<option value="'.$com->nombre.'">'.$com->nombre.'</option>';
                                                    }
                                                    ?>  
                                                </select>
                                            </div>
                                            <div class="col-12">
                                            <div class="form-group">
                                                <label for="Item">Item a enviar </label>
                                                <input type="text" id="item" class="form-control" name="item" placeholder="Item"/>
                                            </div>
                                            <div class="col-12">
                                            <div class="form-group">
                                                <label for="Costo">Costo item </label>
                                                <input type="text" id="cost" class="form-control" name="cost" placeholder="Precio Item"/>
                                            </div>
                                            <div class="col-12">
                                            <div class="form-group">
                                                <select name="select_type" class="form-select" id="select_type">
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
</style>
</html>

