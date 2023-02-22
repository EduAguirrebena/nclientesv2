<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="card">
                <div class="col-12 col">
                    <input type="file" class="form-control" id="excel-input">
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <row class="col-12">
            <table id="excel-table">
                <thead> 
                    <tr>

                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </row>
    </div>
    <button onclick="ExportToExcel('xlsx')">Export table to excel</button>
<script src="js/xlsxReader.js"></script>
<script src="https://unpkg.com/read-excel-file@5.x/bundle/read-excel-file.min.js"></script>

<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

<script>
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('excel-table');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ?
            XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64'}):
            XLSX.writeFile(wb, fn || ('MySheetName.' + (type || 'xlsx')));
        }
</script>

</body>
</html> -->



   

<?php

$date1 = "2023-02-01";

$inicio = date("Y-m-01");
$timestamp1 = strtotime($inicio);

$fin = date("Y-m-t");
$timestamp2 = strtotime($fin);

// $timestamp2 = strtotime($date2);
// echo $timestamp2;


?>


    <!-- <div id="auth">
      <div class="row h-100">
        <div class="col-lg-5 col-12">
          <div id="auth-left">
            <h1 class="auth-title">Inicie Sesión</h1>
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
    </div> -->

    <div class="auth-wrapper col-3">
  <div class="auth-content">
    <div class="card text-center">
      <div class="card-body">
        <div class="row">

          <!-- <div class="col-md-12">
          <div class="alert alert-info">
          <h5>Importante:</h5>
          No realizaremos envíos este 31 de octubre y 01 de noviembre. Planifica tus envíos desde el 02 de noviembre
          </div> -->

          <h3 class="mb-3">Bienvenido a <br><span class="text-c-blue">SPREAD</span></h3>
          <p>Soluciones de Última Milla.</p>
          <!-- ingreso -->
          <div class="toggle-block">
            <ol class="position-relative carousel-indicators justify-content-center">
            <li class="toggle-btn"></li>
            <li class="active"></li>
            </ol>
            <form id="ingreso">
            <div class="form-group mb-3">
            <label class="floating-label" for="email_cliente">Ingresa tu E-mail</label>
            <input type="email" class="form-control" name="email_cliente" id="email_cliente">
            </div>
            <div class="form-group mb-3">
            <label class="floating-label" for="password_cliente">Ingresa tu contraseña</label>
            <input type="password" class="form-control" name="password_cliente" id="password_cliente">
            </div>
            </form>
            <button class="btn btn-primary mb-4" id="btn-ingresar">Ingresar</button>
            <button class="btn btn-outline-primary mb-4 toggle-btn">¡Quiero registrarme!</button>
            <p class="mb-2 text-muted">¿Olvidaste tu contraseña? <a href="olvido_password.php" class="f-w-400">¡Reiníciala!</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>