<?php

require "../Admin_Funciones/conecta.php";
$con = conecta();

$id = $_GET['id'];

$sql = "SELECT * FROM empleados WHERE id = $id";
$res = $con->query($sql);
$row = $res->fetch_assoc();

$nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : $row['nombre'];
$apellidos = isset($_REQUEST['apellidos']) ? $_REQUEST['apellidos'] : $row['apellidos'];
$correo = isset($_REQUEST['correo']) ? $_REQUEST['correo'] : $row['correo'];
$pass = isset($_REQUEST['pass']) ? $_REQUEST['pass'] : ''; 
$rol = isset($_REQUEST['rol']) ? $_REQUEST['rol'] : $row['rol'];
$passEnc = md5($pass);

$archivo_n = $row['archivo_n']; 
$archivo = $row['archivo']; 


if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == UPLOAD_ERR_OK) {
    $file_tmp = $_FILES['archivo']['tmp_name'];
    $arreglo = explode(".", $_FILES['archivo']['name']);
    $len = count($arreglo);
    $pos = $len - 1;
    $ext = $arreglo[$pos];
    $file_enc = md5_file($file_tmp);

    if ($file_tmp != '') {
        $fileName1 = "$file_enc.$ext";
        $dir = "../Admin_Archivos/";
        copy($file_tmp, $dir . $fileName1);

        $archivo_n = $fileName1;
        $archivo = $_FILES['archivo']['name'];
    }
}

$sqlUpdate = "UPDATE empleados
              SET nombre = '$nombre', apellidos = '$apellidos', correo = '$correo', pass = '$passEnc', rol = $rol, archivo_n = '$archivo_n', archivo = '$archivo'
              WHERE id = $id";
$resUpdate = $con->query($sqlUpdate);

header("Location: empleados_lista.php");
?>
