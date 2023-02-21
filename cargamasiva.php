<?php 
        session_start();
        $id_cliente = $_SESSION['cliente']->id_cliente;
        require_once('ws/bd/dbconn.php');
        $conexion = new bd();
        $conexion->conectar();
?>


<!DOCTYPE html>
<html lang="en">
    <?php
        include_once('../nclientesv2/include/head.php');
    ?>
<body>
    <div id="app">
        <!-- SideBar -->
        <?php
            include_once('../nclientesv2/include/sidebar.php');
        ?>
       
        <div id="main"  class="layout-navbar">

            <?php
                include_once('./include/topbar.php');
            ?>
                <div class="container">
        <div class="row">
            <div class="card">
                <div class="col-12 col">
                    <input type="file" class="form-control" id="excel-input">
                </div>
            </div>
        </div>
    </div>
    <input type="text" name="" value="123" id="comprobador"/><button id="pressme">PressMe</button>
    <a download href="./xlsx/books.xlsx">Enlace para descargar mp3 con su nombre original</a>

    <div style="background-color: beige; margin: 15px">
        <div class="card-header">
            <h3>Resumen Pedido</h3>
            <h6>Si existen errores podrás editarlos en la misma tabla!</h6>
        </div>
        <div id="tablepp">
            <table class="table table-striped" id="excel_table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Comuna</th>
                        <th>Item</th>
                        <th>Valor</th>
                        <th>Tipo Envío</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
                
            </table>
        </div>
    </div>
    <button onclick="ExportToExcel('xlsx')">Export table to excel</button>
    <script src="js/xlsxReader.js"></script>
    <script src="https://unpkg.com/read-excel-file@5.x/bundle/read-excel-file.min.js"></script>

    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>


    <div class="collapse" id="modexcelrow">
        <h1>HOLAAAAAAAAA</h1>
    </div>
    <div class="page-content" style="color:3e3e3f;">
    <?php
        include_once('../nclientesv2/include/footer.php')
    ?>

</body>
<script>
$('#excel-table td').on('click',function(){
    console.log("eiii")
})


$('#select_comuna').on('click', function(){
    comunas.forEach(function(comunas){
        $(this).add(new Option(comunas))
    })
    
})
    $('#pressme').click(function(){
    })
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('excel-table');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ?
            XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64'}):
            XLSX.writeFile(wb, fn || ('MySheetName.' + (type || 'xlsx')));
        }
</script>
</html>