`<section class="collapse" id="modexcelrow"><div class="row match-height"><div class="col-12"><div class="card"><div class="card-header"><h4 class="card-title">Modificar Datos</h4></div><div class="card-content"><div class="card-body"><form class="form"><div class="row"><div class="col-md-6 col-12"><div class="form-group"><label for="first-name-column">Nombre</label><input type="text" id="first-name-column" class="form-control"placeholder="First Name" name="fname-column"></div></div><div class="col-md-6 col-12"><div class="form-group"><label for="direccion-column">Direccion</label><input type="text" id="direccion-column" class="form-control"placeholder="Dirección" name="direccion-column"></div></div><div class="col-md-6 col-12"><div class="form-group"><label for="telefono-column">Teléfono</label><input type="text" id="telefono-column" class="form-control" placeholder="Teléfono"name="telefono-column"></div></div><div class="col-md-6 col-12"><div class="form-group"><label for="correo-floating">Correo</label><input type="email" id="correo-floating" class="form-control"name="correo-floating" placeholder="Correo"></div></div><div class="col-md-6 col-12"><div class="form-group"><label for="comuna-column">Comuna</label><select name="select_comuna" class="form-select" id="select_region"><option value=""></option><?phpforeach($comunas as $comuna):?><option value=""><?php echo $comuna?></option><?phpendforeach;?></select></div></div><div class="col-md-6 col-12"><div class="form-group"><label for="item-column">Nombre Item</label><input type="text" id="item-column" class="form-control"name="item-column" placeholder="Item"></div></div><div class="col-md-6 col-12"><div class="form-group"><label for="precio-column">Precio</label><input type="text" id="precio-column" class="form-control"name="precio-column" placeholder="Precio"></div></div><div class="form-group col-md-6 col-12"><div class="form-group"><label for="type_select">Tipo paquete</label><select name="type_select" id="type_select" class="form-select"><option value=""></option><option value="1">Mini</option><option value="2">Medium</option></select></div></div><div class="col-12 d-flex justify-content-end"><button type="button" class="btn btn-primary me-1 mb-1">Modificar</button></div></div></form></div></div></div></div></div></section>`