class Excel{

    constructor(content){
        this.content = content;
    }
    header(){
        
        return new row(this.content[0]);
        //return this.content[0];
       
    }
    rows(){
        return new rowCollection(this.content.slice(1,this.content.length));
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
            
            if (i == 0 || i==2 || i==3)
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
    const content = await readXlsxFile(excelInput.files[0]); 

    const excel = new Excel(content);
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

    console.log(excelPrinter.printexc('excel-table',excel));
    // console.log(excel.header());

    // console.log(excel.header().trackid());
    // console.log(excel.header().documentNumber());
    // console.log(excel.header().cliente());

    //console.log(excel.header().customrow(3));
    


})