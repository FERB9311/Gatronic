<?php
require "../Admin_Funciones/conecta.php";
$con = conecta();

$id = $_GET['id'];

$sql = "SELECT * FROM productos WHERE id = $id";
$res = $con->query($sql);
$row = $res->fetch_assoc();

$nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : $row['nombre'];
$codigo = isset($_REQUEST['codigo']) ? $_REQUEST['codigo'] : $row['codigo'];
$descripcion = isset($_REQUEST['descripcion']) ? $_REQUEST['descripcion'] : $row['descripcion'];
$costo = isset($_REQUEST['costo']) ? $_REQUEST['costo'] : ''; 
$stock = isset($_REQUEST['stock']) ? $_REQUEST['stock'] : $row['stock'];


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

$sqlUpdate = "UPDATE productos
              SET nombre = '$nombre', codigo = '$codigo', descripcion = '$descripcion', costo = '$costo', stock = $stock, archivo_n = '$archivo_n', archivo = '$archivo'
              WHERE id = $id";
$resUpdate = $con->query($sqlUpdate);

header("Location: productos_lista.php");
?>
