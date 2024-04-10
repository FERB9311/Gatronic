<?php
require "../Admin_Funciones/conecta.php";
$con = conecta();
$id = $_REQUEST['id'];

$sql = "UPDATE empleados SET eliminado = 1 WHERE id = $id";
$res = $con->query($sql);

if ($res) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('success' => false));
}

?>
