<?php
session_start();
require "conecta.php";
$con = conecta();

$id_producto = $_REQUEST['id_producto'];
$cantidad    = $_REQUEST['cantidad'];
$id_cliente  = $_SESSION['idUserc'];   

// Validar si existe pedido abierto para el usuario logueado
$sql ="SELECT * FROM pedidos WHERE id_cliente = $id_cliente AND status = 0";
$res = $con->query($sql);
$num = $res->num_rows;

if($num == 0){
    $fecha = date('Y-m-d h:i:s');
    $sql = "INSERT INTO pedidos (fecha, id_cliente) VALUES('$fecha', $id_cliente)";
    $con->query($sql);
    $id_pedido = $con->insert_id;
} else{
    $row = $res->fetch_assoc();
    $id_pedido = $row['id_pedido'];
}

// Obtener precio
$sql = "SELECT * FROM productos WHERE id = $id_producto";
$res = $con->query($sql);
$row = $res->fetch_assoc();
$precio = $row['costo'];

// Insertar producto
$sql = "INSERT INTO pedidos_productos
        (id_pedido, id_producto, cantidad, precio)
        VALUES($id_pedido, $id_producto, $cantidad, '$precio')";
$con->query($sql);


?>
