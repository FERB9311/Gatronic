<?php
    session_start();
    require "conecta.php";
    $con = conecta();

    define('COMPANY_NAME'  , 'Gatronic');
    define('COMPANY_EMAIL' , 'noreplay@gatronic.com');
    
    function get_cart($id_cliente, $con) {
        // Consultar los productos en el carrito del cliente
        $sql = "SELECT pp.id_producto, p.nombre, p.codigo, p.costo, pp.cantidad, p.stock
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
                    'id'       => $row['id_producto'],
                    'nombre'   => $row['nombre'],
                    'codigo'   => $row['codigo'],
                    'costo'    => $row['costo'],
                    'cantidad' => $row['cantidad'],
                    'stock'    => $row['stock'],
                ];
                $carrito['products'][] = $producto;
    
                // Calcular el subtotal 
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

        // Obtener precio
        $sql = "SELECT * FROM productos WHERE id = $id_producto";
        $res = $con->query($sql);
        $row = $res->fetch_assoc();
        $precio = $row['costo'];
    
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
            $sql_insert = "INSERT INTO pedidos_productos (id_pedido, id_producto, cantidad, precio) VALUES ($id_pedido, $id_producto, $cantidad, $precio)";
            $con->query($sql_insert);
            return true; // Indica que se insertó correctamente
        }
    }

    function update_cart_product($id_cliente, $con, $id_producto, $cantidad){
        $sql_update = "UPDATE pedidos_productos SET cantidad = $cantidad WHERE id_pedido IN (SELECT id FROM pedidos WHERE id_cliente = $id_cliente AND status = 0) AND id_producto = $id_producto";
            $con->query($sql_update);
            return true;
    }

    function delete_from_cart($id_cliente, $con, $id_producto) {
        // Eliminar el producto del carrito
        $sql_delete = "DELETE FROM pedidos_productos WHERE id_pedido IN (SELECT id FROM pedidos WHERE id_cliente = $id_cliente AND status = 0) AND id_producto = $id_producto";
        $con->query($sql_delete);
    
        // Verificar si se eliminó correctamente
        $sql_check = "SELECT * FROM pedidos_productos WHERE id_pedido IN (SELECT id FROM pedidos WHERE id_cliente = $id_cliente AND status = 0) AND id_producto = $id_producto";
        $res_check = $con->query($sql_check);
    
        if ($res_check->num_rows > 0) {
            return false; // No se eliminó correctamente
        } else {
            return true; // Se eliminó correctamente
        }
    }
    
    
    
    function destroy_cart($id_cliente, $con) {
        // Obtener el ID del pedido abierto del cliente
        $sql_pedido = "SELECT id FROM pedidos WHERE id_cliente = $id_cliente AND status = 0";
        $res_pedido = $con->query($sql_pedido);
    
        if ($res_pedido->num_rows > 0) {
            $row_pedido = $res_pedido->fetch_assoc();
            $id_pedido = $row_pedido['id'];
    
            // Eliminar todos los productos del carrito (pedidos_productos) asociados al ID del pedido
            $sql_delete = "DELETE FROM pedidos_productos WHERE id_pedido = $id_pedido";
            $con->query($sql_delete);
    
            return true; // Indica que el carrito se vació correctamente
        } else {
            return false; // Indica que no se encontró un pedido abierto para el cliente
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

    function get_order_resume($id_cliente, $con) {
    
        // Obtener los detalles de los productos relacionados con el cliente logueado
        $sql_select_productos = "SELECT pp.id_producto, p.nombre, p.codigo, p.costo, pp.cantidad
            FROM pedidos_productos pp
            INNER JOIN productos p ON pp.id_producto = p.id
            INNER JOIN pedidos ped ON pp.id_pedido = ped.id
            WHERE ped.id_cliente = $id_cliente AND ped.status = 0"; 
        $res = $con->query($sql_select_productos);
    
        // Verificar si se ejecutó correctamente la consulta
        if (!$res) {
            return false;
        }

        // Actualizar el estado del pedido a 1 (completado)
        $sql_update_pedido = "UPDATE pedidos SET status = 1 WHERE id_cliente = $id_cliente AND status = 0";
        $con->query($sql_update_pedido);
    
        // Array para almacenar los detalles de los productos
        $order_resume = ['products' => []];
        $subtotal = 0;
    
        // Verificar si se obtuvieron resultados
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $producto = [
                    'nombre' => $row['nombre'],
                    'codigo' => $row['codigo'],
                    'costo' => $row['costo'],
                    'cantidad' => $row['cantidad']
                ];
                $order_resume['products'][] = $producto;
                $subtotal += $row['costo'] * $row['cantidad']; // Sumar al subtotal
            }
        }
    
        // Asignar subtotal a total
        $order_resume['subtotal'] = $subtotal;
        $order_resume['total'] = $subtotal;
    
        // Guardar los detalles de los productos en la sesión
        $_SESSION['order_resume'] = $order_resume;
    
        return $order_resume;
    }
    
      
    function send_email($to , $subject = 'Nuevo mensaje' , $msg = NULL) {
      
        if(!filter_var($to , FILTER_VALIDATE_EMAIL)) {
          return false;
        }
      
        if($msg == NULL) {
          $msg = "
          <html>
          <head>
          <title>HTML email</title>
          </head>
          <body>
          <p>This email contains HTML Tags!</p>
          <table>
          <tr>
          <th>Firstname</th>
          <th>Lastname</th>
          </tr>
          <tr>
          <td>John</td>
          <td>Doe</td>
          </tr>
          </table>
          </body>
          </html>
          ";
        }
      
        // Always set content-type when sending HTML email
        $headers  = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: '.COMPANY_NAME.' <'.COMPANY_EMAIL.'>' . "\r\n";
        // More headers
      
        mail($to,$subject,$msg,$headers);
        return true;
    }
    
?>