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
        let countererr =0
        //console.log(rows);

        const heads = [];
        let incorrecto = 0
        for(i=0; i < 7;i++ )
        {
            // if(arrays.row[i] == null){
            //     heads.push(arrays.row[i]);
            // }

            console.log(arrays.row[i])
            if(headcorrect[i] == heads[i]){
                console.log("correcto")
                
            }
            else if(heads[i] == null){
                console.log("incorrecto");
                incorrecto ++
            }else{
                console.log("incorrecto");
                incorrecto ++
            }
        }
        console.log(incorrecto);
        // 
        if(incorrecto>0)
        {
            console.log("ARCHIVO NO CUMPLE CON EL FORMATO")
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
                            console.log("fila 2 contador en 0");
                        }
                        console.log(row[i])

                        if(i==0 && row[i] == null)
                        {
                            let nomerr = "Debe ingresar un nombre";
                            console.log(nomerr);
                            countererr++
                        }
                        if(i==1 && row[i] == null)
                        {
                            let direrr = "Debe ingresar una direccion";
                            console.log(direrr);
                            countererr++
                        }
                        if(i==2 && row[i] == null)
                        {
                            let telerr = "Debe ingresar un telefono";
                            console.log(telerr);
                            countererr++
                        }
                        if(i==3 && row[i] == null)
                        {
                            let corerr = "Debe ingresar un correo";
                            console.log(corerr);
                            countererr++
                        }
                        if(i==4 && row[i] == null)
                        {
                            let comerr = "Debe ingresar una comuna";
                            console.log(comerr);
                            countererr++
                        }
                        if(i==5 && row[i] == null)
                        {
                            let deserr = "Debe ingresar una descripcion";
                            console.log(deserr);
                            countererr++
                        }
                        if(i==6 && row[i] == null)
                        {
                            let coserr = "Debe ingresar el costo";
                            console.log(coserr);
                            countererr++
                        }
                        if(i==7 && row[i] == null)
                        {
                            let typeerr = "Debe ingresar el tipo de envio";
                            console.log(typeerr);
                            countererr++
                        }

                        if(countererr > 4)
                        {
                            break
                        }
                        
                        counter ++
                        console.log("EL CONTADOR VA EN"+counter);
                    }

                    }
                    

                })
                console.log("HE SALIDO DEL INFIERNO ->> AHORA SE REINICIAR[A EL CONTADOR DE ERRORES");
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

