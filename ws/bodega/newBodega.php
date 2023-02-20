<?php
    session_start();

    $json = file_get_contents('php://input');

    $data = json_decode($json);
    

    include_once('/xampp/htdocs/nclientesv2/ws/bd/dbconn.php');
    
    //                      "direccion": calle,
    //                     "numero": numero,
    //                     "nombre":nombre,
    //                     "comuna":comuna,

    $id_cliente = $_SESSION['cliente']->id_cliente;
    $direccion = $data->direccion;
    $numero = $data->numero;
    $nombre = $data->nombre;
    $comuna = $data->comuna;
    $conn = new bd();

    $conn ->conectar();
    
    $query = "INSERT INTO bodega (id_bodega,nombre_bodega,calle_bodega,numero_bodega,principal_bodega,isDelete,DeleteDate,user_delete_id,id_cliente,id_comuna) 
              VALUES(null,'$nombre','$direccion','$numero','0','0',null,null,'$id_cliente','$comuna')";
              
        if($conn->mysqli->query($query)){
            
        } else {
            echo false;
        }
?>