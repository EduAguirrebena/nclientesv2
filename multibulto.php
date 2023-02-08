<!doctype html>
<html lang="en">

<head>
	<title>Add or Remove Input Fields Dynamically</title>
	<link rel="stylesheet" href=
	"//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		<link rel="stylesheet" href=
	"https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
	</script>

	<style>
		body {
			display: flex;
			flex-direction: column;
			margin-top: 1%;
			justify-content: center;
			align-items: center;
		}

		#rowAdder {
			margin-left: 17px;
		}
	</style>
</head>

<body>
	<h2 style="color:green">GeeksforGeeks</h2>
	<strong> Adding and Deleting Input fields Dynamically</strong>

	<div style="width:40%;">

		<form>
			<div class="">
				<div class="col-lg-12">
					<div id="row">
						<div class="input-group m-3">
							<div class="input-group-prepend">
                                <div class="counter" >
                                    <p id="counterrp" value="1"></p>
                                </div>
								<button onclick="substract()" class="btn btn-danger"
									id="DeleteRow" type="button">
									<i class="bi bi-trash"></i>
									Delete
								</button>
							</div>
							<input type="text"
								class="form-control m-input">
						</div>
					</div>

					<div id="newinput"></div>
					<button id="rowAdder" onclick="add()" type="button"
						class="btn btn-dark">
						<span class="bi bi-plus-square-dotted">
						</span> ADD
					</button>
				</div>
			</div>
		</form>
	</div>

	<script type="text/javascript">
		count = 1;
		function add(){
			
			
		}

		function substract(){
			
			
		}
		$("#rowAdder").click(function () {
			if (count >= 10)
			{
				console.log("no se pueden tener mas de 10 registros");
			}
			else{
					count++;
				console.log(count);
				newRowAdd =
				'<div id="row"> <div class="input-group m-3">' +
				'<div class="input-group-prepend">' +
				`<div class="counter"><p id="counterrp" value="">${count}</p></div>`+
				'<button class="btn btn-danger" id="DeleteRow" type="button">' +
				'<i class="bi bi-trash"></i> Delete</button> </div>' +
				`<p id="counterp">numero</p>`+
				'<input type="text" class="form-control m-input"> </div> </div>';
				$('#newinput').append(newRowAdd);
			}
			
		});
	
		$("body").on("click", "#DeleteRow", function () {

			if(count<=1){
				console.log("no se pueden tener 0 registros")
			}
			else{
				count--;
				console.log(count);
				$("#DeleteRow").parents("#row").remove();
			}
		})
				
		
	</script>
</body>

</html>
