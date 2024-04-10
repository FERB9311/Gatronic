<?php
    require "conecta.php";
    $con = conecta();

    $correoe = $_POST['correo'];

    $sql = "SELECT * FROM empleados WHERE status = 1 AND eliminado = 0 AND correo = '$correoe'";
    
    $res = $con->query($sql);

    echo json_encode(array('count' => $res->num_rows, 'correo' => $correoe));



?>
