<?php
    session_start();
    require "conecta.php";
    $con = conecta();

    $correo = $_POST['correo'];
    $pass = $_POST['pass'];


    
    $sql = "SELECT * FROM cliente WHERE correo = ? AND pass = ?";
    
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $correo, $pass);
    $stmt->execute();
    $res = $stmt->get_result();

    
    $num_filas = $res->num_rows;

    if($num_filas == 1){
        $row        = $res->fetch_array();
        $id         = $row["id"];
        $nombre     = $row["nombre"];
        $correo     = $row["correo"];

        $_SESSION['idUserc'] = $id;
        $_SESSION['nombreUserc'] = $nombre;
        $_SESSION['correoUserc'] = $correo;
    }

    
    header('Content-Type: application/json');
    echo json_encode($num_filas);
    

?>
