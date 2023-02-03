<?php
    session_start();
    if(!isset($_SESSION['cliente']))
    {
        header("Location: index.php");
    }
    $id_cli = $_SESSION['cliente']->id_cliente;

    include_once('../nclientesv2/ws/bd/dbconn.php');

    $conn = new bd();
    $conn->conectar();



    $query ='SELECT p.id_pedido,p.timestamp_pedido,b.nombre_bodega FROM pedido p
            INNER JOIN cliente c ON (p.id_cliente=c.id_cliente)
            INNER JOIN bodega b ON (p.id_bodega=b.id_bodega)
            WHERE c.id_cliente='. $id_cli .' AND p.estado_pedido>=2';

    $existe = false;
    if($res = $conn->mysqli->query($query)){
        $datapedido = array();
        
        while($datares = $res ->fetch_object())
        {
            $datapedido [] = $datares;
        }
        $size = sizeof($datapedido);
        $res -> close();
        $datapedido = (object)$datapedido;
        $existe = true;
       
        
    }
    else{
        echo $conn->mysqli->error;
        exit();
    }
    $suma=0;
    for ($i = 0; $i<=$size; $i ++){
        
    }
    
    if($existe)
    {
        foreach($datapedido as $pedido){
            $req = "SELECT sum(precio_bulto)as precio from bulto where id_pedido =".$pedido->id_pedido.";";
            
            $restotal = mysqli_query($conn->mysqli ,$req);
            $row = mysqli_fetch_assoc ($restotal);
            $total = $row['precio'];
            echo $total."<br>";
        }
        $conn -> desconectar();

    }
   
?>