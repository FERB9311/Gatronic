<?php
require "../Admin_Funciones/conecta.php";
$con = conecta();

// Recibe variables
$nombre = $_REQUEST['nombre'];

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

$sql = "INSERT INTO promociones
        (nombre, archivo)
        VALUES ('$nombre', '$archivo_n')";
$res = $con->query($sql);

header("Location: promociones_lista.php");
?>
