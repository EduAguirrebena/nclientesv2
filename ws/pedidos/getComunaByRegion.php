<?php
    
    include_once('../bd/dbconn.php');
    $idregion = $_POST['idregion'];
        $conn = new bd();
        $conn->conectar();

    $query = 'SELECT CONVERT(co.nombre_comuna USING utf8) as nombre FROM provincia pro
            inner join comuna co on co.id_provincia = pro.id_provincia
            inner join region re on re.id_region = pro.id_region
            where re.id_region ='.$idregion.";";

    if($res = $conn -> mysqli->query($query)){
            while($datareg = mysqli_fetch_array($res))
                {
                    $nombre = $datareg['nombre'];
                    $return_array[]=array(
                        "nombre" => $nombre
                    );
            }
            echo json_encode($return_array);
        
    }


    





?>