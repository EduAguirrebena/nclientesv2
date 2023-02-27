<?php 
	session_start();
    include('ws/bd/dbconn.php');

    $conn = new bd();
	$conn->conectar();
	
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


<!doctype html>
<html lang="en">
<?php
	include_once('./include/head.php')
?>
<body>
<div id="app" >
        <!-- SideBar -->
        <?php
            include_once('../nclientesv2/include/sidebar.php');
        ?>
            



        <div id="main"  class="layout-navbar">
            <?php
                include_once('./include/topbar.php');
            ?>
            
            <div class="page-content" >

				<h2 style="color:green">GeeksforGeeks</h2>
				<strong> Adding and Deleting Input fields Dynamically</strong>

				
				<div >
						<div class="">
							<div class="col-lg-12">
								<div class="everyclass" id="row">
									<div class="input-group m-3">
										<section>
											<div class="row match-height">
												<div >
													<div class="card">
													<div class="card-header">
														<h4 class="card-title">Formulario de envío(Datos destinatario)</h4>
														<input type="text" class="form-control m-input" value="1"/>
													</div>
													<div class="card-content">
														<div class="form-bodyenvio">
														<form class="form form formvalidar" id="toValidateBulto1">
															<div class="form-body">
															<div class="row">
																<div class="col-6">
																<div class="form-group">
																	<label for="gg">Nombre</label>
																	<input type="text" id="nombredestinatario" class="form-control nombre" name="nombredestinatario[0]" placeholder="Nombre Destinatario"/>
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
																
																<div class="col-6 divregion">
																	<label for="select_region">Región </label>
																	<select name="select_region" class="form-select sel_region" id="select_region">
																		<option value=""></option>
																		<?php 
																		foreach($comunas as $com)
																		{
																			echo '<option value="'.$com->id.'">'.$com->nombre.'</option>';
																		}
																		?>  
																	</select>
																</div>
																<div class="col-6 divcomuna">
																	<label for="Comuna">Comuna</label>
																	<select name="select_comuna" class="form-select sel_comuna" id="select_comuna">
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
																<div class="row justify-content-start">
																	<button type="submit" class="submit btn btn-primary me-1 mb-1 col-md-4 col-12" value="Submit"> Enviar </button>
																	<button class="btn btn-danger col-md-2 col-12"
																			id="DeleteRow" type="button">
																			<i class="bi bi-trash"></i>
																		Borrar
																	</button>
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
								</div>



								
			
								<div id="newinput"></div>
									<button id="rowAdder" type="button"
										class="btn btn-dark">
										<span class="bi bi-plus-square-dotted">
										</span> ADD
									</button>
									<button id="formValidate" type="submit"
										class="btn btn-dark">
										<span class="bi bi-plus-square-dotted">
										</span> VALIDAR
									</button>
							</div>
						</div>
					
				</div>

			</div>

	<?php
		include_once('./include/footer.php')
	?>
	  <script src="assets/js/jquery-validation/jquery.validate.js"></script>

	
	<script type="text/javascript">
			counter = 1;
			counterelementindex= 0 ;

			// '<div id="row"> <div class="input-group m-3" >'+
            // '<div class="input-group-prepend">' +
            // '<button class="btn btn-danger" id="DeleteRow" type="button">' +
            // '<i class="bi bi-trash"></i> Delete</button> </div>' +
            // `<input type="text" class="form-control m-input" value="${counter} "></div> </div>`;
		$(document).ready(function(){
			let options = {rules:{
						'nombredestinatario[]': {
							required : true,
							minlength:5
						},
						numtel:{
							required:true}
						}}

			$( "#toValdiateBulto" ).each( function() {
				$( this ).validate( options );
			} );

			
				// 	$('#Valdiarmulti').validate(
				// 		{rules:{
				// 		'nombredestinatario[]': {
				// 			required : true,
				// 			minlength:5
				// 		},
				// 		numtel:{
				// 			required:true}
					// },messages:{
					// 	'nombredestinatario[]':{
					// 			required:"Debe ingresar un nombre",
					// 			minlength:"El largo minimo son 5 caracteres"
					// 		}
					// },submitHandler: function(form){
						
				// 	}
				// })
			
		})
			


			
		
 
        $("#rowAdder").click(function () {

			if(counter < 10)
			{
				counter ++
				console.log(counter);
				let index = counter - 1

				let clone = $('#row').clone()
				clone.find("#nombredestinatario").val("")
				let nombre = clone.find(".nombre").attr('name')
				let nombrenew = nombre.replace('['+(0)+']', '['+index+']')  
				let form = clone.find(".formvalidar")
				let idform = form.attr('id')
				console.log(idform);
				let newformid = idform.replace( idform,"toValidateBulto"+counter)
				console.log(newformid);

				form.attr('id', newformid);

				

				clone.find(".nombre").attr('name',nombrenew);
				console.log(nombrenew);
				clone.attr('name',name)
				clone.find("#numtel").val("") 
				clone.find("#dir").val("") 
				clone.find("#correo").val("") 
				clone.find("#select_region").val("") 
				clone.find("#select_region").addClass("clonedreg") 
				clone.find("#select_comuna").val("") 
				clone.find("#select_comuna").addClass("clonedcom")
				clone.find("#cost").val("") 
				clone.find("#select_type").val("") 
				clone.find(".m-input").val(counter) 
				clone.appendTo("#newinput")
			}
			else{
				console.log("Limite de 10 alcanzado");
			}
        });
 
        $("body").on("click", "#DeleteRow", function () {
            
			if(counter<=1){
			 		console.log("no se pueden tener 0 registros")
				}
				else{
					counter--;
					console.log(counter);
					//console.log(counter);
					let actual = $(this).closest('#row').find('.m-input').val();
					// console.log(actual);
					let minput = document.getElementsByClassName('m-input')
					
					var nombreind = document.getElementsByClassName('nombre')
					var formgetid = document.getElementsByClassName("formvalidar")
					//let substarter = actual; 

					for(var index=0;index < minput.length;index++){

						if(index+1>actual){
							minput[index].value = index

							//console.log(nombreind);
							let indexfixed = index-1
							let indexplus = index+1
							let nombre = nombreind[index].getAttribute('name')
							let nombrenew = nombre.replace('['+(index)+']', '['+indexfixed+']')  
							//console.log("El nuevo nombre a Asignar es "+nombrenew);
							nombreind[index].name = nombrenew;
							//console.log("El nuevo nombre es: "+ nombrenew);
							let idform = formgetid[index].id;
						    console.log("EL ID ENTRANTE ES "+idform+" VAMOS EN EL INDEX "+index);
							console.log("SE INTENTARA REEMPLAZAR ESTO "+"toValidateBulto"+indexplus);
							console.log("SE INTENTARA REEMPLAZAR ESTO "+"toValidateBulto"+index);
							let newformid = idform.replace( "toValidateBulto"+indexplus, "toValidateBulto"+index )
							console.log("LA NUEVA CADENA DE FORM ES " + newformid);
							idform[index].id = newformid; 
						}	
					}
					$(this).parents("#row").remove();
				}
        })

		$(".clonedcom").on('click',function(){
			let idregion = $(this).closest("#row").find(".clonedreg").val();
			console.log(idregion);
			

		})


		$(".sel_comuna").on('click',function(){
			let idregion = $(this).closest("#row").find(".sel_region").val();
			console.log(idregion);
		})
    </script>
	
		
</body>

</html>
