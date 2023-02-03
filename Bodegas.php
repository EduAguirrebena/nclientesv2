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
                <div class="row">
                    <div class="col-md-5 col-sm-12">
                        <div class="card bodega">
                            <div class="card-content">
                                <img class="card-img-top img-fluid" src="/dist/assets/images/project/Google-maps-platform-para-el-retail.jpg"
                                    alt="Card image cap" style="height: 20rem" />
                                <div class="card-body" id="cardbodywarehouse">

                                    <h4 class="card-title">Uno Poniente 1140</h4>
                                    <p  style="flex-direction: column-reverse;">Casa</p>
                                    
                                    <p class="card-text">
                                        Talagante
                                    </p>
                                    <button class="btn btn-primary block">Enviar desde acá</button>
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                         data-bs-target="#danger"data-bs-toggle="tooltip"
                                         data-bs-placement="top" title="Eliminar Bodega">
                                         <i class="fa-solid fa-trash"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                                         data-bs-target="#ModForm" data-bs-toggle="tooltip"
                                         data-bs-placement="top" title="Editar bodega">
                                         <i class="fa-solid fa-pen"></i>
                                    </button>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-12">
                        <div class="card bodega">
                            <div class="card-content">
                                <img class="card-img-top bodega img-fluid" src="/dist/assets/images/project/Google-maps-platform-para-el-retail.jpg"
                                    alt="Card image cap" style="height: 20rem" />
                                <div class="card-body" id="cardbodywarehouse">
                                    <h4 class="card-title">Gamero 2580</h4>
                                    <p  style="flex-direction: column-reverse;">Bodega</p>
                                    <p class="card-text">
                                       Independencia
                                    </p>
                                    <button class="btn btn-primary block btnwh">Enviar desde acá</button>
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                         data-bs-target="#danger"data-bs-toggle="tooltip"
                                         data-bs-placement="top" title="Eliminar Bodega">
                                         <i class="fa-solid fa-trash"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                                         data-bs-target="#ModForm" data-bs-toggle="tooltip"
                                         data-bs-placement="top" title="Editar bodega">
                                         <i class="fa-solid fa-pen"></i>
                                    </button>
                           
                                </div>
                            </div>
                        </div>
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
                                            class="form-control">
                                    </div>
                                    <label>Calle </label>
                                    <div class="form-group">
                                        <input type="password" placeholder="Dirección"
                                            class="form-control">
                                    </div>
                                    <label>Número </label>
                                    <div class="form-group">
                                        <input type="text" placeholder="Número"
                                            class="form-control">
                                    </div>
                                    <label>Comuna</label> </label>
                                    <div class="input-group mb-3">
                                        <label class="input-group-text"
                                            for="inputGroupSelect01">Comunas</label>
                                        <select class="form-select" id="inputGroupSelect01">
                                            <option selected>Comuna...</option>
                                            <option value="1">Talagante</option>
                                            <option value="2">Quilicura</option>
                                            <option value="3">Independencia</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-secondary"
                                        data-bs-dismiss="modal">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Cancelar</span>
                                    </button>
                                    <button type="button" class="btn btn-primary ml-1"
                                        data-bs-dismiss="modal">
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Agregar</span>
                                    </button>
                                </div>
                            </form>
                    </div>
                </div>


            
            </div>
            <!--Modificar Bodega form Modal -->
            <div class="modal fade text-left" id="ModForm"  tabindex="-1" role="dialog"
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
                    <form action="#">
                        <div class="modal-body">
                            <label>Nombre </label>
                            <div class="form-group">
                                <input type="text" placeholder="Nombre"
                                    class="form-control">
                            </div>
                            <label>Calle </label>
                            <div class="form-group">
                                <input type="password" placeholder="Dirección"
                                    class="form-control">
                            </div>
                            <label>Número </label>
                            <div class="form-group">
                                <input type="text" placeholder="Número"
                                    class="form-control">
                            </div>
                            <label>Comuna</label> </label>
                            <div class="input-group mb-3">
                                <label class="input-group-text"
                                    for="inputGroupSelect01">Comunas</label>
                                <select class="form-select" id="inputGroupSelect01">
                                    <option selected>Comuna...</option>
                                    <option value="1">Talagante</option>
                                    <option value="2">Quilicura</option>
                                    <option value="3">Independencia</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary"
                                data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Cancelar</span>
                            </button>
                            <button type="button" class="btn btn-primary ml-1"
                                data-bs-dismiss="modal">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Agregar</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
   <!-- Footer contiene div de main app div -->
   <?php
        include_once('../nclientesv2/include/footer.php')
    ?>

</html>