<!DOCTYPE html>
<html lang="en">
  <?php
    include_once('./include/head.php')
  ?>

  <body>
    <div id="auth">
      <div class="row h-100">
        <div class="col-lg-5 col-12">
          <div id="auth-left">
            <div class="auth-logo">
              <a href=""><img src="" alt="Logo"
              /></a>
            </div>
            <h1 class="auth-title">Log in.</h1>
            <p class="auth-subtitle mb-5">
              Lorem ipsum dolor sit amet.
            </p>

            <form id="ingreso">
              <div class="form-group position-relative has-icon-left mb-4">
              <label class="floating-label" for="email_cliente">Ingresa tu correo</label>
                <input
                  type="email"
                  class="form-control"
                  placeholder="example@correo.cl"
                  name="email_cliente"
                  id="email_cliente"
                />
                <div class="form-control-icon">
                  <i class="bi bi-person"></i>
                </div>
              </div>
              <div class="form-group position-relative has-icon-left mb-4">
              <label class="floating-label" for="password_cliente">Ingresa tu contraseña</label>
                <input
                  type="password"
                  class="form-control"
                  placeholder="Contraseña"
                  name="password_cliente"
                  id="password_cliente"
                />
                <div class="form-control-icon">
                  <i class="bi bi-shield-lock"></i>
                </div>
              </div>
              <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" id="btn-ingresar">
                Ingresar
              </button>
            </form>
            <div class="text-center mt-5 text-lg fs-4">
              <p class="text-gray-600">
                Don't have an account?
                <a href="auth-register.html" class="font-bold">Sign up</a>.
              </p>
              <p>
                <a class="font-bold" href="auth-forgot-password.html"
                  >Forgot password?</a
                >.
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
          <div id="auth-right"></div>
        </div>
      </div>
    </div>

  <script src="./assets/extensions/jquery/jquery.js"></script>
  <script src="./assets/js/jquery-validation/jquery.validate.js"></script>
  <script src="./assets/extensions/sweetalert2/sweetalert2.min.js"></script>
  
  <!-- <script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/pages/pcoded.min.js"></script>
  <script src="assets/js/pages/ripple.js"></script> -->
  
  <script>
    $(document).ready(function(){
      $("#btn-ingresar").click(function() {
    		$("#ingreso").submit();
    	});

      $('#ingreso').validate({
        rules: {
                email_cliente: {
                    required: true,
                    email: true
                },
                password_cliente: {
                    required: true,
					minlength: 6
                }
            },
          messages: {
                email_cliente: "Por favor ingrese un email válido",
                password_cliente: {
                  required: "Por favor ingrese su password",
                  minlength: "Debe poseer por lo menos 6 caracteres"
				        }
            },highlight: function(element) {
                var $el = $(element);
                console.log($el);
                var $parent = $el.parents(".form-group");
                $el.addClass("es-invalido");

                // Select2 and Tagsinput
                if ($el.hasClass("select2-hidden-accessible") || $el.attr("data-role") === "tagsinput") {
                    $el.parent().addClass("es-invalido");
                }
            },
            unhighlight: function(element) {
                $(element).parents(".form-group").find(".es-invalido").removeClass("es-invalido");
            },
            submitHandler: function(form) {
                $(".btn").prop('disabled', true);
                $.ajax({
                    type: "POST",
                    url: "./ws/cliente/ingresar.php",
                    data: $("#ingreso").serialize(),
                    success: function(data) {
                        if(data.success==1) {
                        	window.location.href = "./";
                        }
                        else {
							  swal(data.titulo, data.message, "error");
                        	$("#password_cliente").val("");
                        }
                    	$("#registro").trigger("reset");
                    },
                    error: function(data){
                    }
                });
                $(".btn").prop('disabled', false);
            }
      });



    });
  </script>
    
  
  </body>
</html>


