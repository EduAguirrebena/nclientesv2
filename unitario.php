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
                            re.nombre_region as region,
                            bo.id_bodega as id
                        FROM bodega bo
                        inner join comuna co on co.id_comuna = bo.id_comuna
                        inner join provincia pro on pro.id_provincia = co.id_provincia
                        inner join region re on re.id_region = pro.id_region
                        where bo.id_cliente ='.$id_cliente;

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
    require_once('include/head.php');
 ?>
<body>
<div id="app">
        <!-- SideBar -->
        <?php
            include_once('../nclientesv2/include/sidebar.php');
        ?>
            

</div>

        <div id="main"  class="layout-navbar">
            <?php
                include_once('./include/topbar.php');
            ?>
            
            <div class="page-content" >
                
            <div class="container">
                <div class="card">
                    <div class="dropdown">
                        <button class="btn btn-primary col-12 " style="padding: 5px;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                              
                            <div class="row">
                                <div class="col-4" style="text-align: start;">
                                        <label for="">
                                                Mis Datos
                                        </label>
                                </div>
                                <div class="col-4" style="text-align: start;">

                                    <?php

                                        foreach($bodegas as $bodega):
                                            
                                            $main = $bodega->principal;
                                            if($main):
                                        ?>
                                            <label id="resumemyData" style="text-align: center;">
                                             <?php echo $bodega->nombre.' | '. $bodega->calle.' '.$bodega->numero?>                                                   
                                            </label>
                                        <?php
                                                endif;
                                            endforeach;
                                        ?>
                                </div>
                                <div class="col-4" style="text-align: right;">
                                    <i class="fa-solid fa-arrow-down"></i>
                                </div>
                            </div>

                        </button>
                        <div class="collapse" id="collapseExample">
                            <div class="row justify-content-center align-items-center g-2">
                            <section id="multiple-column-form">
                                <div class="row match-height">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-content">
                                                    <div class="col-12" style="text-align: end;">
                                                        <a class="btn rounded-pill" data-bs-toggle="collapse" data-bs-target="#collapseotherdir" 
                                                            aria-expanded="false" aria-controls="collapseotherdir">
                                                                    Enviaré desde otra dirección
                                                        </a>
                                                        
                                                    </div>
                                                <div class="card-bod">
                                                   
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="dirchose">Dirección</label>
                                                                    <input type="text" id="dirchose" class="form-control"
                                                                        placeholder="" name="fname-column" <?php

                                                                                                                    foreach($bodegas as $bodega):
                                                                                                                        
                                                                                                                        $main = $bodega->principal;
                                                                                                                        if($main):
                                                                                                                    ?>
                                                                                                                            value="<?php echo $bodega->calle.' '.$bodega->numero.', '.$bodega->comuna.', '.$bodega->region?>">
                                                                                                                    <?php
                                                                                                                            endif;
                                                                                                                        endforeach;
                                                                                                                    ?>
                                                                </div>
                                                            </div>
                                                            
                                                            <form >
                                                                <div class="row carddireccion" id="<?php echo $bodega->id?>">
                                                                    <?php
                                                                        foreach($bodegas as $bodega):
                                                                        $main = $bodega->principal;
                                                                    ?>
                                                                        <div class="col-lg-3 col-md-4 col-sm-6 col-12" >
                                                                                <div class="card bodega">
                                                                                    <div class="card-content" style="justify-content: center;">
                                                                                        <div class="card-body" id="cardbodywarehouse" >
                                                                                            <div class="row">
                                                                                                <h4 class="card-title col-10"><?php echo $bodega->nombre?></h4>
                                                                                                <?php if($main==1):?>
                                                                                                    <input class="col-2" style="align-items: flex-start;" value="<?php echo $bodega->id?>" type="radio" name="Usar" id="usardir" checked>

                                                                                                <?php else:?>
                                                                                                    <input class="col-2" style="align-items: flex-start;" value="<?php echo $bodega->id?>" type="radio" name="Usar" id="usardir" >
                                                                                                    
                                                                                                <?php endif;?>
                                                                                            </div>
                                                                                            
                                                                                            <p style="flex-direction: column-reverse;"><?php echo $bodega->calle.' '.$bodega->numero?></p>
                                                                                            <p class="card-text">
                                                                                            <?php echo $bodega->comuna.', '.$bodega->region?>
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                        </div>
                                                                    <?php
                                                                            endforeach;                                                                    
                                                                    ?>
                                                                </div>
                                                            </form>
                                                            
                                                          
                                                                <div class="row collapse  form" id=collapseotherdir>
                                                                <form class="form" id="formdir">
                                                                        <div class="direnvio row" style="background-color: #66cab2;">
                                                                            <div class="col-8">
                                                                                <label for=""><h3>Mi Dirección</h3> (lugar donde retiraremos tú pedido)</label>
                                                                            </div>
                                                                            <div class="form-check form-switch col-4" style="justify-items: end;">
                                                                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                                                                <label class="form-check-label" for="flexSwitchCheckDefault">Guardar dirección</label>
                                                                            </div>
                                                                            <div class="col-md-6 col-lg-6 col-sm-8" >
                                                                                <div class="form-group">
                                                                                    <label for="form_dir">Dirección</label>
                                                                                    <input type="text" id="form_dir" name="form_dir" class="form-control"
                                                                                        placeholder="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3 col-lg-3 col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label for="form_numero">Número</label>
                                                                                    <input type="text" id="form_numero" name="form_numero" class="form-control"
                                                                                        placeholder="Casa, Depto, Bodega, etc." >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3 col-lg-3 col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label for="first-name-column">Nombre</label>
                                                                                    <input type="text" id="form_nombre" name="form_nombre" class="form-control"
                                                                                        placeholder="Casa, Depto, Bodega, etc.">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-lg-6 col-sm-8">
                                                                                <label for="Comuna">Región </label>
                                                                                <select class="form-select" name="select_regioncli" id="select_regioncli">
                                                                                    <option value=""></option>
                                                                                    <?php 
                                                                                        foreach($comunas as $com)
                                                                                        {
                                                                                            echo '<option value="'.$com->id.'">'.$com->nombre.'</option>';
                                                                                        }
                                                                                    ?>  
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-6 col-lg-6 col-sm-8">
                                                                                <label for="Comuna">Comuna</label>
                                                                                <select class="form-select" name="select_comunacli" id="select_comunacli">
                                                                                    <option value=""></option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 d-flex justify-content-end">
                                                                            <button  type="submit" class="submit btn btn-primary me-1 mb-1" value="Submit"> Usar esta dirección </button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                           
                                                            
                                                      </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
                
            </div>
                    <section>
                        <div class="row match-height">
                            <div >
                                <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Formulario de envío(Datos destinatario)</h4>
                                </div>
                                <div class="card-content">
                                    <div class="form-bodyenvio">
                                    <form class="form form" id="toValdiateBulto">
                                        <div class="form-body">
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
                                                    foreach($comunas as $com)
                                                    {
                                                        echo '<option value="'.$com->id.'">'.$com->nombre.'</option>';
                                                    }
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
                                                <button type="submit" class="submit btn btn-primary me-1 mb-1 col-12" value="Submit"> Enviar </button>
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
            <button id="buttonsubmit">
                 pressme                                       
            </button>

            <?php
                include_once('../nclientesv2/include/footer.php')
            ?>
            <script src="assets/js/jquery-validation/jquery.validate.js"></script>

            <script src="./js/newPedido.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    <?php 
        foreach($bodegas as $bodega):
            if($bodega->principal == 1):
    ?>

    var id_bodega=<?=$bodega->id?>;
    
    <?php
            endif;
        endforeach;
    ?>
    // var select_box_element = document.querySelector('#select_box');

    // dselect(select_box_element, {
    //     search: true
    // });
    document.querySelectorAll("#usardir").forEach(el => {
            el.addEventListener("click", e => {
                let id = e.target.getAttribute("value");
                id_bodega = id;
                // alert(id);
                $.ajax({
                    type: "POST",
                    url: "ws/bodega/getbodegaById.php",
                    dataType: 'json',
                    data: {
                        "id_bodega" : id
                    },
                    success: function(data) {
                        console.log(data);

                        $.each(data, function (key, value){
                            
                            document.getElementById("dirchose").innerHTML = ""+value.direccion+' '+value.numero+', '+value.comuna+', '+value.region+"";
                            
                            document.getElementById("resumemyData").innerHTML = ""+value.nombre+'| '+value.direccion+' '+value.numero+"";
                            
                        })
                        
                    },
                        error: function(data){
                    }
                })
            });
        });
    
        $("#select_type").change(function(){
           console.log(this.value);
           var value = this.value; 
           var x = document.getElementById("tipoenvio");
        //    alert(x.textContent +"   " +value);
           
            if(value==="1"){
                x.innerHTML = "Rango de peso";
                
            }
            if(value==="mini"){
                x.innerHTML = "De 0.1 a 5.0 kg";
            }
            if(value==="medium"){
                x.innerHTML = "De 5.1 a 10 kg";
            }
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


$("#select_regioncli").on('change',function(){
    var idregion = this.value;
    var comuna = document.getElementById("select_comunacli");
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
                            let select = document.getElementById("select_comunacli");
                            select.options[select.options.length] = new Option(value.nombre,value.id);
                        })
                        
                    },
                        error: function(data){
                    }
    })
})
    
        $('#formdir').validate({
                    rules:{
                        form_dir:{
                            required :true,
                            minlength : 4
                        },
                        form_numero:{
                            required: true
                        },
                        form_nombre:{
                            required:true
                        },
                        form_comunacli:{
                            required:true
                        },
                        form_regioncli:{
                            reqiured:true
                        }
                    },
                    messages:{
                        form_dir:{
                            required :"Debe ingresar una dirección para el retiro",
                            minlength : "La direccion debe tener al menos 4 caracteres"
                        },
                        form_numero:{
                            required: "Debe ingresar un numero de dirección",
                        },
                        form_nombre:{
                            required:"Ingrese un nombre para su dirección"
                        },
                        form_comunacli:{
                            required:"Seleccione una comuna"
                        },
                        form_regioncli:{
                            reqiured:"Debe Seleccionar una región"
                        }
                    },
                    submitHandler: function(form){
                            
                    
                        try{
                            let vdir = document.getElementById('form_dir').value;
                            let vnumero = document.getElementById('form_numero').value;
                            let vnombre = document.getElementById('form_nombre').value;
                            let vcomuna = document.getElementById('select_comunacli');
                            let vcomunavalue = vcomuna.value;
                            let vregion = document.getElementById('select_regioncli').value;

                            let dataajax = {direccion : vdir,
                                            numero: vnumero,
                                            nombre : vnombre,
                                            comuna : vcomunavalue,
                                            region: vregion};
                            
                    
                            //alert(JSON.stringify(dataajax));
                                    $.ajax({
                                    url: "ws/bodega/newBodega.php",
                                    type: "POST",
                                    data: JSON.stringify(dataajax),
                                    success:function(resp){
                                        
                                        if(resp==="error"){
                                            console.log("creado");
                                            return false; 
                                        }
                                        else{
                                            return false;
                                        }
                                    }
                                    
                                });
                        }
                        catch(error){
                            console.log(error);
                            return false;
                        }    
                        
                           
                           
                            
                    }
                        
                    
                })
   

    // function getclientData() {
    //         let idcliente = <?php echo $id_cliente?>;
           
	// 		$.ajax({
    //                 type: "POST",
    //                 url: "ws/cliente/getclientData.php",
    //                 dataType: 'json',
    //                 data: {
    //                     "id_cliente" : idcliente
    //                 },
    //                 success: function(data) {
    //                     console.log(data);

    //                     $.each(data, function (key, value){
    //                         let select = document.getElementById("select_comuna");
    //                         let name = document.getElementById("resumemyData").innerHTML = value.nombre + " " + value.apellido;
    //                         $("#first-name-column").val(value.nombre + " " + value.apellido);
    //                         //name.text(value.nombre);
    //                         //console.log(value.nombre);
    //                     })
                        
    //                 },
    //                     error: function(data){
    //                 }
    //         })
	// }



    $(".dropdown").click(function(){

        if($(".fa-arrow-down").hasClass("open")){
            $(".fa-arrow-down").removeClass('open');
            $(".fa-arrow-down").addClass('close');
        }
        else{
            $(".fa-arrow-down").addClass('open');
            if($(".fa-arrow-down").hasClass('close'))
            {
                $(".fa-arrow-down").removeClass('close');
            }
        }
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

