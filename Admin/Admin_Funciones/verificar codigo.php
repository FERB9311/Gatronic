<?php
    require "conecta.php";
    $con = conecta();

    $codigoe = $_POST['codigo'];

    $sql = "SELECT * FROM productos WHERE status = 1 AND eliminado = 0 AND codigo = '$codigoe'";
    
    $res = $con->query($sql);


    echo json_encode(array('count' => $res->num_rows, 'codigo' => $codigoe));

?>
