




class Excel{

    constructor(content){
        this.content = content;
    }
    header(){
        return new row(this.content[5]);
        //return this.content[0];
    }
    rows(){
        return new rowCollection(this.content.slice(6,this.content.length));
    }
}

class rowCollection{
    constructor(rows){ 
        this.rows = rows;
    }
  
    first(){
        return  new row(this.rows[0]);
    }
    get(index)
    {
        return new row(this.rows[index]);
    }
    count(){
        return this.rows.length;
    }
}

class row{
    constructor(row)
    {
        this.row = row;
    }
    trackid(){
        return this.row[2];
    }
    documentNumber(){
        return this.row[0];
    }
    cliente(){
        return this.row[3];
    }
    customrow(index){
        return this.row[index];
    }
}

class excelPrinter{

    static printexc(table, excel){

        const  tabla =document.getElementById(table);

        for (let i =0; i<= 30 ; i++){
            if (i==0 || i==2 || i==3)
            {
                let headtotable = excel.header().customrow(i);
                tabla.querySelector("thead>tr").innerHTML += `<td>${headtotable}</td>`
            }
        }
        const largo = excel.rows().count();
        for(let ind =0 ; ind <= largo; ind ++){

            const trackid = excel.rows().get(ind).trackid();
            const documentNumber = excel.rows().get(ind).documentNumber();
            const cliente = excel.rows().get(ind).cliente();
            tabla.querySelector("tbody").innerHTML += `<tr><td>${trackid}</td>
                                                        <td>${documentNumber}</td>
                                                        <td>${cliente}</td></tr>`
        }
    }
}
        



const excelInput = document.getElementById('excel-input');


excelInput.addEventListener('change',async function(){
    const content = await readXlsxFile(excelInput.files[0])
        const excel = new Excel(content);
        let arrays = excel.header();
        let headcorrect = ["NOMBRE CLIENTE FINAL","DIRECCION ENTREGA","TELEFONO","Email cliente (opcion)","COMUNA ENTREGA","NOMBRE ITEM","COSTO ITEM","PAQUETE"]
        let rows = excel.rows()
        let length = excel.rows().count()
        counter = 0
        let ingresados = 0 
        let countererr = 0

        var filatabla = ""
        //console.log(rows);
        var formularioModificar= `<section class="collapse" id="modexcelrow">`+
        `<div class="row match-height">`+
        `<div class="col-12">`+
        `<div class="card">`+
        `<div class="card-header">`+
        `<h4 class="card-title">Modificar Datos</h4>`+
        `</div>`+
        `<div class="card-content">`+
        `<div class="card-body">`+
        `<form class="form">`+
        `<div class="row">`+
        `<div class="col-md-6 col-12">`+
        `<div class="form-group">`+
        `<label for="first-name-column">Nombre</label>`+
        `<input type="text" id="first-name-column" class="form-control"`+
        `placeholder="First Name" name="fname-column">`+
        `</div>`+
        `</div>`+
        `<div class="col-md-6 col-12">`+
        `<div class="form-group">`+
        `<label for="direccion-column">Direccion</label>`+
        `<input type="text" id="direccion-column" class="form-control"`+
        `placeholder="Dirección" name="direccion-column">`+
        `</div>`+
        `</div>`+
        `<div class="col-md-6 col-12">`+
        `<div class="form-group">`+
        `<label for="telefono-column">Teléfono</label>`+
        `<input type="text" id="telefono-column" class="form-control" placeholder="Teléfono"`+
        `name="telefono-column">`+
        `</div>`+
        `</div>`+
        `<div class="col-md-6 col-12">`+
        `<div class="form-group">`+
        `<label for="correo-floating">Correo</label>`+
        `<input type="email" id="correo-floating" class="form-control"`+
        `name="correo-floating" placeholder="Correo">`+
        `</div>`+
        `</div>`+
        `<div class="col-md-6 col-12">`+
        `<div class="form-group">`+
        `<label for="comuna-column">Comuna</label>`+
        `<select name="select_comuna" class="form-select" id="select_region">`+
        `<option value=""></option>`+
        `<?php`+
        `foreach($comunas as $comuna):`+
        `?>`+
        `<option value=""><?php echo $comuna?></option>`+
        `<?php`+
        `endforeach;`+
        `?>`+
        `</select>`+
        `</div>`+
        `</div>`+
        `<div class="col-md-6 col-12">`+
        `<div class="form-group">`+
        `<label for="item-column">Nombre Item</label>`+
        `<input type="text" id="item-column" class="form-control"`+
        `name="item-column" placeholder="Item">`+
        `</div>`+
        `</div>`+
        `<div class="col-md-6 col-12">`+
        `<div class="form-group">`+
        `<label for="precio-column">Precio</label>`+
        `<input type="text" id="precio-column" class="form-control"`+
        `name="precio-column" placeholder="Precio">`+
        `</div>`+
        `</div>`+
        `<div class="form-group col-md-6 col-12">`+
        `<div class='form-group'>`+
        `<label for="type_select">Tipo paquete</label>`+
        `<select name="type_select" id="type_select" class="form-select">`+
        `<option value=""></option>`+
        `<option value="1">Mini</option>`+
        `<option value="2">Medium</option>`+
        `</select>`+
        `</div>`+
        `</div>`+
        `<div class="col-12 d-flex justify-content-end">`+
        `<button type="button" class="btn btn-primary me-1 mb-1">Modificar</button>`+
        `</div>`+
        `</div>`+
        `</form>`+
        `</div>`+
        `</div>`+
        `</div>`+
        `</div>`+
        `</div>`+
        `</section>`

        //CAPTURADORES DE ERORRES
        var nombre = ""
        var nomerr = ""        
        var direrr = ""
        var telerr = ""
        var corerr = ""
        var comerr = ""
        var deserr = ""
        var coserr = ""
        var typeerr = ""

        const heads = []
        let tdrow = []
        let incorrecto = 0
        for(i=0; i < 7;i++ )
        {
            heads.push(arrays.row[i]);

            //console.log(arrays.row[i])
            if(headcorrect[i] == heads[i]){
                //console.log("correcto")
            }
            else if(heads[i] == null){
                //console.log("incorrecto");
                incorrecto ++
            }else{
                //console.log("incorrecto");
                incorrecto ++
            }
        }
        //console.log(incorrecto);
        // 
        if(incorrecto>0)
        {
            //console.log("ARCHIVO NO CUMPLE CON EL FORMATO")
            let alerta = ("El formato del documento es incorrecto, por favor descargue nuestro excel tipo para continuar") 
            document.getElementById('comprobador').value = alerta
        }
        else{
            let array =rows.rows
                array.forEach(row => {
                    //console.log(row)
                    if(countererr>4)
                    {

                    }
                    else{
                        for(i=0 ; i<8 ; i++){
                            if(counter == 8){
                                counter = 0
                                countererr = 0
                                console.log("FILA 2 COUNTER = 0");
                                tdrow =[]
                            }
                            console.log(row[i])

                            tdrow.push(row[i])
                            

                            //console.log(verifynombre(row[i]))

                            if(i==0 && row[i] == null)
                            {
                                nomerr = "Debe ingresar un nombre";
                                console.log(nomerr);
                                countererr++
                            }
                            else if(i==0 && row[i].length < 5){
                                nomerr = "El nombre debe tener al menos 5 caracteres";
                                //console.log(direrr);
                            }
                            else{
                                nombre = row[i]
                            }

                            if(i==1 && row[i] == null)
                            {
                                direrr = "Debe ingresar una dirección";
                                console.log(direrr);
                                countererr++
                            }
                            else if(i==1 && row[i].length < 5){
                                direrr = "La dirección debe tener al menos 5 caracteres";
                                //console.log(direrr);
                            }

                            if(i==2 && row[i] == null)
                            {
                                telerr = "Debe ingresar un telefono";
                                console.log(telerr);
                                countererr++
                            }
                            else if(i==2 && row[i].length < 5){
                                telerr = "El teléfono debe tener al menos 9 caracteres";
                            }

                            if(i==3 && row[i] == null)
                            {
                                corerr = "Debe ingresar un correo";
                                console.log(corerr);
                                countererr++
                            }else if(i==3 && row[i].length < 7){
                                corerr = "El correo debe tener al menos 7 caracteres";
                                
                            }

                            if(i==4 && row[i] == null)
                            {
                                comerr = "Debe ingresar una comuna";
                                console.log(comerr);
                                countererr++
                            }

                            if(i==5 && row[i] == null)
                            {
                                deserr = "Debe ingresar una descripcion";
                                console.log(deserr);
                                countererr++
                            }else if(i==5 && row[i].length < 3){
                                deserr = "La descripción debe tener al menos 3 caracteres";
                               
                            }

                            if(i==6 && row[i] == null)
                            {
                                coserr = "Debe ingresar el costo";
                                console.log(coserr);
                                countererr++
                            }else if(i==6 && row[i] > 500000){
                                coserr = "El valor declarado no puede superar los $500.000";
                                
                            }

                            if(i==7 && row[i] == null)
                            {
                                typeerr = "Debe ingresar el tipo de envio";
                                console.log(typeerr);
                                countererr++
                            }

                            
                            counter ++

                            console.log("EL CONTADOR VA EN"+counter)
                            console.log("EL CONTADOR DE ERRORES VA EN "+countererr);

                            if(countererr > 4)
                            {
                                break
                            }
                            else if(counter == 8 && countererr <= 4){
                                
                                let json_error = {
                                    "nombre" : nomerr,
                                    "direccion" : direrr,
                                    "telefono" : telerr,
                                    "correo" : corerr,
                                    "comuna" : comerr,
                                    "descripcion" : deserr,
                                    "costo" : coserr,
                                    "tipo" : typeerr
                                }
                                //console.log(json_error);
                                

                                tdrow.forEach(td=>{
                                    if(td == null){
                                        td = ""
                                    }
                                    filatabla += "<td>"+ td +"</td>"
                                })

                                console.log("------------------------");
                                console.log("VER ARREGLO DE DATOS PARA TABLA");
                                console.log(filatabla);
                                console.log("-------------------------");
                                


                                $('#excel_table > thead').append(   "<tr>"+
                                                                        "<th>Nombre</th>"+
                                                                        "<th>Dirección</th>"+
                                                                        "<th>Teléfono</th>"+
                                                                        "<th>Correo</th>"+
                                                                        "<th>Comuna</th>"+
                                                                        "<th>Item</th>"+
                                                                        "<th>Valor</th>"+
                                                                        "<th>Tipo Envío</th>"+
                                                                    "</tr>") 


                                                                    
                                $('#excel_table > tbody:last').append("<tr>"+ filatabla +"<td>"+`<button data-bs-toggle="collapse" data-bs-target="#modexcelrow" aria-expanded="false" aria-controls="modexcelrow" class="modexceldata" title="Modificar">
                                                                                                    <i class="fa-solid fa-pen-to-square" ></i>
                                                                                                    </button>`+"</td>"+"</tr>"+"<tr>"+ formularioModificar+"</tr>");
                            }
                        }
                    }
                })
                console.log("HE SALIDO DEL INFIERNO => DEMASIADOS ERRORES");
               

                
        }

    //console.log(excelPrinter.printexc('excel-table',excel));
    //console.log(excel.header());
    // console.log(excel.header().trackid());
    // console.log(excel.header().documentNumber());
    // console.log(excel.header().cliente());
    //console.log(excel.header().customrow(3));
    //console.log(excel.header());
    // console.log(excel.rows().first());
    // console.log(excel.rows().get(35).trackid());
    // console.log(excel.rows().count());
    // console.log(excel.rows().first().cliente());
    // console.log(excel.rows().first().trackid());
    // console.log(excel.rows().first().documentNumber());
    // for(i=0 ; i<100 ;i ++){
    //     console.log(excel.rows().get(i).trackid())
    // }

})




