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
                <h3>Mis Datos || Spread</h3>
            </div>
            <div class="page-content">
                
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div>
                            <div class="card-header">
                                <h4 class="card-title">Datos Personales</h4>
                            </div>
                            <div class="card-content">
                                <div class="bodycard" id="cngpd">
                                    <form class="form form-vertical">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Nombre</label>
                                                        <input type="text" id="first-name-vertical"
                                                            class="form-control" name="fname"
                                                            placeholder="Nombre" value="Jose Miguel Loyola Vargas">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="email-id-vertical">Correo</label>
                                                        <input type="email" id="email-id-vertical"
                                                            class="form-control" name="email-id"
                                                            placeholder="Correo Electronico" value="coteloyola@hotmail.com">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="contact-info-vertical">Rut</label>
                                                        <input type="number" id="contact-info-vertical"
                                                            class="form-control" name="contact"
                                                            placeholder="Rut" value="20.136.448-5">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="password-vertical">Celular</label>
                                                        <input type="text" id="password-vertical"
                                                            class="form-control" name="contact"
                                                            placeholder="Celular" value="953061585">
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit"
                                                        class="btn btn-primary me-1 mb-1">Submit</button>
                                                    <button type="reset"
                                                        class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="col-lg-6 col-md-12">
                        <div class="">
                            <div class="card-header">
                                <h4 class="card-title">Modificar contraseña</h4>
                            </div>
                            <div class="card-content">
                                <div class="bodycard" id="cngpd">
                                    <form class="form form-vertical">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Constraseña actual</label>
                                                        <input type="text" id="first-name-vertical"
                                                            class="form-control" name="fname" placeholder="Constraseña">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12" style="margin:30px 0px;">
                                                    <h5>
                                                        Nueva Contraseña
                                                    </h5>

                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <input type="email" id="email-id-vertical"
                                                            class="form-control" name="email-id"
                                                            placeholder="Nueva contraseña" >
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <input type="number" id="contact-info-vertical"
                                                            class="form-control" name="contact"
                                                            placeholder="Confirmar contraseña" >
                                                    </div>
                                                </div> 
                                            </div>
                                            <br>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit"
                                                    class="btn btn-primary me-1 mb-1">Submit</button>
                                                <button type="reset"
                                                    class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
               
            </div>


            

           <?php
            include_once('../nclientesv2/include/footer.php')
           ?>
        

           
        </div>
    <!-- Footer contiene div de main app div -->
    <?php
        include_once('../nclientesv2/include/footer.php')
    ?>
    
</body>

</html>