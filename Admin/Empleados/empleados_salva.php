<?php
require "../Admin_Funciones/conecta.php";
$con = conecta();

// Recibe variables
$nombre = $_REQUEST['nombre'];
$apellidos = $_REQUEST['apellidos'];
$correo = $_REQUEST['correo'];
$pass = $_REQUEST['pass'];
$rol = $_REQUEST['rol'];
$passEnc = md5($pass);


$archivo_n = '';
$archivo = ''; 

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


$sql = "INSERT INTO empleados
        (nombre, apellidos, correo, pass, rol, archivo_n, archivo)
        VALUES ('$nombre', '$apellidos', '$correo', '$passEnc', $rol, '$archivo_n', '$archivo')";
$res = $con->query($sql);

header("Location: empleados_lista.php");
?>
