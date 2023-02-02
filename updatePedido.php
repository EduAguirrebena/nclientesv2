<?php

 include_once('ws/bd/dbconn.php');

 $conn = new bd();

 $conn->conectar();





?>

<!DOCTYPE html>
<html lang="en">
    <?php

        include_once('../Spread/include/head.php');

    ?>
<body>

    <?php

        include_once('../Spread/include/sidebar.php');

    ?>


    <div id="main">
                <header class="mb-3">
                    <a href="#" class="burger-btn d-block d-xl-none">
                        <i class="bi bi-justify fs-3"></i>
                    </a>
                </header>

                <div class="page-heading">
                    <div class="row">
                        <div class="col-sm-9">
                            <h3>Modificar Bultos || Spread</h3>
                        </div>
                        
                        
                    </div>
                    
                </div>
                <div class="page-content">

                    
                </div>

                
    </div>

    <?php
        include_once('../Spread/include/footer.php');
    ?>
    
</body>
</html>