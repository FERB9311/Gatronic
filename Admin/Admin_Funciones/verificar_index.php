<?php
    session_start();
    require "conecta.php";
    $con = conecta();

    $correoe = $_POST['correo'];
    $password = $_POST['password'];

    
    $password_encriptada = md5($password);

    
    $sql = "SELECT * FROM empleados WHERE status = 1 AND eliminado = 0 AND correo = ? AND pass = ?";
    
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $correoe, $password_encriptada);
    $stmt->execute();
    $res = $stmt->get_result();

    
    $num_filas = $res->num_rows;

    if($num_filas == 1){
        $row        = $res->fetch_array();
        $id         = $row["id"];
        $nombre     = $row["nombre"].' '.$row["apellidos"];
        $correo     = $row["correo"];

        $_SESSION['idUser'] = $id;
        $_SESSION['nombreUser'] = $nombre;
        $_SESSION['correoUser'] = $correo;
    }

    
    echo json_encode($num_filas);


?>
