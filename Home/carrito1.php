<!DOCTYPE html>
<?php session_start(); ?>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- font awesome -->
    <link rel="stylesheet" href="http://use.fontawesome.com/releases/v5.6.3/css/all.css">

    <!-- Waitme -->
    <link rel="stylesheet" href="Home_estilos/waitMe.min.css">
</head>

<body>
    <?php include "Home_Funciones/header.php" ?>

    <!-- Contenido -->
    <div class="container-fluid py-5">
        <div class="d-flex justify-content-center align-items-center">
            <div class="col-xl-4 bg-light">
                <h1 class="text-center">Carrito</h1>
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-center">Total</th>
                                <th class="text-right"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="align-middle">
                                    Producto 1
                                    <small class="d-block text-muted">khjkhkjlkh</small>
                                </td>
                                <td class="align-middle text-center" width=40%>
                                    <input type="number" class="form-control form-control-small" min="0" max="50" value="1">
                                </td>
                                <td class="align-middle text-center">$ 134</td>
                                <td class="text-right align-middle"><i class="fas fa-times text-danger"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-sm btn-danger">Vaciar carrito</button>
                <br><br>
                <table class="table">
                    <tr>
                        <th class="border-0">Subtotal</th>
                        <td class="text-success border-0" style="text-align:right;">$ 649</td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td class="text-success" style="text-align:right;">
                            <h3 class="font-weight-bold">$649</h3>
                        </td>
                    </tr>
                </table>
                <!-- Fin de la tabla de los totales del carrito -->
                
                <button class="btn btn-info btn-lg btn-block">Pagar ahora</button>
                


            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="container-fluid bg-light py-5">
        <footer id="footer">
            <div class="row">
                <div class="col-xl-4">
                    <ul class="list-unstyled">
                        <li><a href="#">Instagram</a></li>
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Twitter</a></li>
                    </ul>
                </div>
                <div class="col-xl-4">
                    <ul class="list-unstyled">
                        <li><a href="#">Inicio</a></li>
                        <li><a href="#">Productos</a></li>
                        <li><a href="#">Contacto</a></li>
                        <li><a href="#">Derechos reservados</a></li>
                        <li><a href="#">Términos y condiciones</a></li>
                    </ul>
                </div>
                <div class="col-xl-4">
                    <p>Desarrollado por <a href="#">Gatronic</a></p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.33.1/dist/sweetalert2.all.min.js"></script>

    

    <!-- Waitme -->
    <script src="Home_estilos/waitMe.min.js"></script>
</body>

</html>
