<?php

    require_once 'functions.php';
    //print_r($_SERVER['REQUEST_METHOD']);
    if(!isset($_POST['action'])){
        http_response_code(403);
        echo json_encode(['status' => 403]);
        die;
    }
    $id_cliente = $_SESSION['idUserc'];

    $action = $_POST['action'];

    //GET
    switch($action){
        case 'get':
            $cart = get_cart($id_cliente, $con);
            $output = '';
            
            if(!empty($cart['products'])){
                // Verificar si hay productos en el carrito
                $output .= '
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th class="text-center">Precio</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-center">Total</th>
                                <th class="text-right"></th>
                            </tr>
                        </thead>
                        <tbody>';
                
                // Iterar sobre cada producto en el carrito
                foreach ($cart['products'] as $product) {
                    $output .= '
                    <tr>
                        <td class="align-middle">' . $product['nombre'] . '
                            <small class="d-block text-muted">' . $product['codigo'] . '</small>
                        </td>
                        <td class="align-middle text-center">'.format_currency($product['costo']).'</td>
                        <td class="align-middle text-center" width=40%>
                            <input type="number" class="form-control form-control-small" min="0" max="50" value="' . $product['cantidad'] . '">
                        </td>
                        <td class="align-middle text-right">'.format_currency(floatval($product['cantidad'] * $product['costo'])).'</td>
                        <td class="text-right align-middle"><i class="fas fa-times text-danger"></i></td>
                    </tr>';
                }
            
                $output .= '
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-sm btn-danger">Vaciar carrito</button>';
            } else {
                // No hay productos en el carrito
                $output .= '
                <div class="text-center">
                    No hay productos en el carrito
                </div>';
            }
            
            // Mostrar subtotal y total
            $output .= '
                <br><br>
                <table class="table">
                    <tr>
                        <th class="border-0">Subtotal</th>
                        <td class="text-success border-0" style="text-align:right;">' . format_currency($cart['subtotal']) . '</td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td class="text-success" style="text-align:right;">
                            <h3 class="font-weight-bold">' . format_currency($cart['total']) . '</h3>
                        </td>
                    </tr>
                </table>
                <!-- Fin de la tabla de los totales del carrito -->
                
                <button class="btn btn-info btn-lg btn-block" disabled>Pagar ahora</button>';
        
         json_output(200, 'OK', $output);  
         break;

        //Agregar al carrito
        case 'post':
            if(!isset($_POST['id'], $_POST['cantidad'])){
                json_output(403);
            }

            if(!add_to_cart($id_cliente, $con, $_POST['id'], $_POST['cantidad'])){
                json_output(400, 'No se pudo agregar al carrito, intenta de nuevo');
            }

            json_output(201);
            break;
        
        default:
        //
         break;
    
    }
?>