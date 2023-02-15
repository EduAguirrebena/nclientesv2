<?php
    session_start();
    include_once('/xampp/htdocs/nclientesv2/ws/bd/dbconn.php');
    
    //                      "direccion": calle,
    //                     "numero": numero,
    //                     "nombre":nombre,
    //                     "comuna":comuna,

    $id_cliente = $_SESSION['cliente']->id_cliente;
    $direccion = $_POST['direccion'];
    $numero = $_POST['numero'];
    $nombre = $POST['nombre'];
    $comuna = $POST['comuna'];
    $conn = new bd();

    $conn ->conectar();

    $query = 'Insert into bodega (nombre_bodega,calle_bodega,numero_bodega,principal_bodega,id_cliente,id_comuna) 
              values('.$nombre.','.$direccion.','.$numero.',0,'.$id_cliente.','.$comuna.')';
    
       
    if ($conn->mysqli->query($query) === TRUE) {
        echo true;
    } else {
        echo false;
    }
?>