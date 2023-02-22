<?php

    $id_bulto = $_POST['id_bulto'];
    require_once('/xampp/htdocs/nclientesv2/ws/bd/dbconn.php');

    $conn = new bd();

    $conn->conectar();

    $query = "SELECT bu.nombre_bulto as nombre,
                    bu.direccion_bulto as direccion,
                    bu.telefono_bulto as telefono,
                    bu.email_bulto as correo,
                    bu.valor_declarado_bulto as valor,
                    bu.descripcion_bulto as item,
                    bu.tipo_servicio_bulto as servicio,
                    re.id_region as region,
                    bu.id_comuna as comuna
                from bulto bu
                inner join provincia pro on pro.id_provincia = bu.id_comuna
                inner join region re on re.id_region = pro.id_region
                where bu.id_bulto = $id_bulto;";

    
    try{
        if($bulto = $conn->mysqli->query($query)){

            while($datares = mysqli_fetch_array($bulto))
            {
                $nombre = $datares['nombre'];
                $direccion = $datares['direccion'];
                $telefono = $datares['telefono'];
                $valor = $datares['valor'];
                $item =$datares['item'];
                $correo = $datares['correo'];
                $servicio = $datares['servicio'];
                $region = $datares['region'];
                $comuna = $datares['comuna'];

                $return_array[]=array(
                    "nombre" => $nombre,
                    "direccion"=>$direccion,
                    "correo" => $correo,
                    "telefono" => $telefono,
                    "valor" => $valor,
                    "item" => $item,
                    "servicio" => $servicio,
                    "region" => $region,
                    "comuna" => $comuna
                );
            }
            $conn->desconectar();
            echo json_encode($return_array);
        }
        else{
            echo $conn->mysqli->error;
        }
    }
    catch(Error $e){
        return $e;
    }
    


    

?>