<?php
if (isset($_SESSION['nombreUserc'])) { 

    define('IMAGES'  , 'Home_Archivos/');
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
                            <input data-id="'.$product['id'].'" data-cantidad="'.$product['cantidad'].'" type="number" class="form-control form-control-sm text-center do_update_cart" value="'.$product['cantidad'].'" min="1" max="'.$product['stock'].'">
                        </td>
                        <td class="align-middle text-right">'.format_currency(floatval($product['cantidad'] * $product['costo'])).'</td>
                        <td class="text-right align-middle">
                            <button class="btn btn-sm btn-danger do_delete_from_cart" data-id="'.$product['id'].'">
                                <i class="fas fa-times"></i>
                            </button>
                        </td>
                    </tr>';
                }
            
                $output .= '
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-sm btn-danger do_destroy_cart">Vaciar carrito</button>';
            } else {
                // No hay productos en el carrito
                $output .= '
                <div class="text-center py-5">
                    <img src="'.IMAGES.'empty-cart.png'.'" title="No hay productos" class="img-fluid mb-3" style="width: 80px;">
                    <p class="text-muted">No hay productos en el carrito</p>
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
                <!-- Fin de la tabla de los totales del carrito -->';
            
                if(!empty($cart['products'])){
                    $output .= '
                        <!-- Payment form -->
                        <form id="do_pay">
                            <button type="submit" class="mt-4 btn btn-info btn-lg btn-block"><b>Pagar ahora</b></button>
                        </form>
                        <!-- END Payment form -->';
                } else{
                    $output .= '
                        <!-- Payment form -->
                        <form id="do_pay">
                            <button type="submit" class="mt-4 btn btn-info btn-lg btn-block" disabled><b>Pagar ahora</b></button>
                        </form>
                        <!-- END Payment form -->';
                }
        
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

        // Actualizar desde el carrito
        case 'put':
            if(!isset($_POST['id'],$_POST['cantidad'])) {
              json_output(403);
            }
        
            if(!update_cart_product($id_cliente, $con, $_POST['id'] , (int) $_POST['cantidad'])) {
              json_output(400,'No se pudo actualizar el producto, intenta de nuevo');
            }
        
            json_output(200);
            break;

        // Eliminar carrito
        case 'destroy':
            if(!destroy_cart($id_cliente, $con)){
                json_output(400, 'No se pudo destruir el carrito, intenta de nuevo');
            }
            json_output(200);
            break;

        // Eliminar del carrito
        case 'delete':
            if(!isset($_POST['id'])){
                json_output(403);
            }

            if(!delete_from_cart($id_cliente, $con, $_POST['id'])){
                json_output(400, 'No se pudo borrar el producto del carrito, intenta de nuevo');
            }

            json_output(200);

            break;

    case 'pay':
        // Verificar que haya un carrito existente
        $cart = get_cart($id_cliente, $con);
        if(empty($cart['products'])) {
        json_output(400,'Tu carrito no tiene productos');
        }
        json_output(200);
    break;

        // Resumen de la orden
        case 'order_resume':
            $c = get_order_resume($id_cliente, $con);
            $output = 
                '<!-- Modal -->
                <div class="modal fade" id="order_resume" tabindex="-1" role="dialog" aria-labelledby="order_resume" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document"> <!-- Agregado modal-lg para hacer el modal más grande -->
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Resumen de compra</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center py-4">
                        <img src="'.IMAGES.'logo.png" alt="Resumen de compra" class="img-fluid" style="width: 100px;">
                        </div>
                        <h3>Gracias por tu compra</h3>
                        <h5 class="my-0"><b>Número de compra #'.rand(10000000, 99999999).'</b></h5>
                        Hemos recibido tu pago '. (isset($_SESSION['nombreUserc']) ? $_SESSION['nombreUserc'] : '') .', aquí tenemos el resumen de tu compra:<br><br>
                        <table class="table table-hover table-striped table-sm">
                        <thead>
                        <tr>
                            <th>Producto</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-right">Total</th>
                        </tr>
                        </thead>
                        <tbody>';
                        foreach ($c['products'] as $p) {
                        $output .= 
                        '<tr>
                            <td class="align-middle" width="25%">
                            <span class="d-block text-truncate">'.$p['nombre'].'</span>
                            <small class="d-block text-muted">SKU '.$p['codigo'].'</small>
                            </td>
                            <td class="align-middle text-center" width="5%">'.$p['cantidad'].'</td>
                            <td class="align-middle text-right">'.format_currency(floatval($p['cantidad'] * $p['costo'])).'</td>
                        </tr>';
                        }
                        $output .= '
                        <tr>
                        <td class="align-middle text-left" colspan="2">Subtotal</td>
                        <td class="align-middle text-right" colspan="1">'.format_currency($c['subtotal']).'</td>
                        </tr>
                        
                        <tr>
                        <td class="align-middle text-left" colspan="2">Total</td>
                        <td class="align-middle text-right" colspan="1">'.format_currency($c['total']).'</td>
                        </tr>
                    
                        <tr>
                        <td class="align-middle text-left" colspan="2">Estado del pago</td>
                        <td class="align-middle text-right" colspan="1">Aprobado</td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                    </div>
                </div>
                </div>';
                // Mensjae al usuario
                send_email('ventas@localhost.com','[Gatronic] Tu resumen de compra',$output);
            
                // Mensaje a la empresa
                send_email('administracion@localhost.com','[Gatronic] ¡Recibimos una nueva venta!','<h1>Este es el resumen de compra del usuario</h1><br><br>'.$output);
                json_output(200,'',$output);
                
            break;

        
        default:
        //
         break;
    
    }
}
?>