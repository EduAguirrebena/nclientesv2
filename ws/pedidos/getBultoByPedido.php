<?php
include_once('../bd/dbconn.php');

    if($_POST){

        $idpedido = $_POST['columnid'];

        $conn = new bd();
        $conn ->conectar();

        $query ='SELECT nombre_bulto as name, direccion_bulto as dir, precio_bulto as precio from bulto where id_pedido ='.$idpedido;

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

          foreach($datapedido as $bulto){
            echo "<tr>
                        <td>
                            <span>".$bulto->name."</span>
                        </td>
                        <td>
                             <span>".$bulto->dir."</span>
                        </td>
                        <td>
                             <span>".$bulto->precio."</span>
                        </td>
                </tr>";
          }
    }


?>