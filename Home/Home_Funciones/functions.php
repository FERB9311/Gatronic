<?php
    session_start();
    require "conecta.php";
    $con = conecta();

    
    
    function get_cart($id_cliente, $con) {
        // Consultar los productos en el carrito del cliente
        $sql = "SELECT pp.id_producto, p.nombre, p.codigo, p.costo, pp.cantidad
                FROM pedidos_productos pp
                INNER JOIN productos p ON pp.id_producto = p.id
                INNER JOIN pedidos ped ON pp.id_pedido = ped.id
                WHERE ped.id_cliente = $id_cliente AND ped.status = 0";
    
        // Ejecutar la consulta
        $res = $con->query($sql);
    
        // Verificar si la consulta se ejecutó correctamente
        if (!$res) {
            die("Error al ejecutar la consulta: " . $con->error);
        }
    
        // Array para almacenar los datos del carrito
        $carrito = ['products' => []];
        $subtotal = 0;
    
        // Verificar si se obtuvieron resultados
        if ($res->num_rows > 0) {
            // Recorrer los resultados y almacenarlos en el array
            while ($row = $res->fetch_assoc()) {
                $producto = [
                    'nombre' => $row['nombre'],
                    'codigo' => $row['codigo'],
                    'costo' => $row['costo'],
                    'cantidad' => $row['cantidad']
                ];
                $carrito['products'][] = $producto;
    
                // Calcular el subtotal sumando el costo de cada producto multiplicado por la cantidad
                $subtotal += $row['costo'] * $row['cantidad'];
            }
        }
    
        // Calcular el total sumando el subtotal más cualquier otro cargo adicional (por ejemplo, impuestos o gastos de envío)
        $total = $subtotal;
    
        // Agregar el subtotal y el total al array de datos del carrito
        $carrito['subtotal'] = $subtotal;
        $carrito['total'] = $total;
    
        return $carrito;
    }
    

    function add_to_cart($id_cliente, $con, $id_producto, $cantidad) {
        // Verificar si el pedido está abierto para el cliente
        $sql_pedido = "SELECT id FROM pedidos WHERE id_cliente = $id_cliente AND status = 0";
        $res_pedido = $con->query($sql_pedido);
    
        // Si no hay pedido abierto, crear uno nuevo
        if ($res_pedido->num_rows == 0) {
            $fecha = date('Y-m-d h:i:s');
            $sql_insert_pedido = "INSERT INTO pedidos (fecha, id_cliente) VALUES ('$fecha', $id_cliente)";
            $con->query($sql_insert_pedido);
            $id_pedido = $con->insert_id;
        } else {
            // Si hay un pedido abierto, obtener su ID
            $row_pedido = $res_pedido->fetch_assoc();
            $id_pedido = $row_pedido['id'];
        }
    
        // Verificar si el producto ya está en el carrito
        $sql_check = "SELECT * FROM pedidos_productos WHERE id_pedido = $id_pedido AND id_producto = $id_producto";
        $res_check = $con->query($sql_check);
    
        if ($res_check->num_rows > 0) {
            // El producto ya está en el carrito, actualizar la cantidad
            $row_check = $res_check->fetch_assoc();
            $cantidad_actual = $row_check['cantidad'];
            $nueva_cantidad = $cantidad_actual + $cantidad;
    
            $sql_update = "UPDATE pedidos_productos SET cantidad = $nueva_cantidad WHERE id_pedido = $id_pedido AND id_producto = $id_producto";
            $con->query($sql_update);
            return true; // Indica que se actualizó correctamente
        } else {
            // El producto no está en el carrito, insertarlo
            $sql_insert = "INSERT INTO pedidos_productos (id_pedido, id_producto, cantidad) VALUES ($id_pedido, $id_producto, $cantidad)";
            $con->query($sql_insert);
            return true; // Indica que se insertó correctamente
        }
    }
    
    
    
    
    

    function json_output($status = 200, $msg = '', $data = []){
        http_response_code($status);
        $r =
        [
            'status' => $status,
            'msg'    => $msg,
            'data'   => $data
        ];
        echo json_encode($r);
        die;
    }

    function format_currency($number, $symbol = '$') {
        if (!is_numeric($number)) {
            $number = 0;
        }
      
        return $symbol . number_format((float)$number, 2, '.', ',');
    }
    
?>