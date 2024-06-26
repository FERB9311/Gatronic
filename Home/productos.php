<?php
session_start();
require "Home_Funciones/conecta.php";
$con = conecta();


$sql = "SELECT * FROM productos WHERE status = 1 AND eliminado = 0";
$res = $con->query($sql);
?>

<html>
<head>
    <title>Productos</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="Home_estilos/bootstrap.min.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="http://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <!-- Waitme -->
    <link rel="stylesheet" href="Home_estilos/waitMe.min.css">
    <!-- Js -->
    <script src="Home_Funciones/Jquery_lib.js"></script>
    <!-- Main -->
    <script src="Home_Funciones/main.js"></script>


    <style>
        .card-img-top {
            width: 150px; /* Tamaño fijo para la imagen */
            height: 150px;
            
            margin: auto; /* Centrar la imagen */
            /* flex: 1;  Hacer que la imagen ocupe todo el espacio disponible */
        }
    </style>

</head>

<body>
    <?php include "Home_Funciones/header.php" ?>

    <!-- Contenido -->
    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-xl-12">
                <br><h1>Productos</h1>
                <div class="row">

                    <?php
                    
                    while ($row = $res->fetch_assoc()) {
                        ?>
                        <div class="col-4 mb-4">
                            <div class="card text-center">
                                <!-- Imagen del producto -->
                                <?php
                                $rutaImagen = "../Admin/Admin_Archivos/" . $row['archivo_n'];
                                ?>
                                <a href="producto_detalle.php?id=<?php echo $row['id'] ?>">
                                    <img src="<?php echo $rutaImagen; ?>" alt="Producto" class="detalle card-img-top"><br>
                                </a>
                                <!-- Nombre del producto -->
                                <h5 class="card-title text-truncate"><?php echo $row['nombre']; ?></h5>
                                <!-- Costo del producto -->
                                <h6>$ <?php echo $row['costo']; ?></h6>
                                <?php if (isset($_SESSION['nombreUserc'])) { ?>
                                    <div class="card-body p-2">
                                        <input type="number" class="form-control mb-2"  placeholder="Cantidad" min="1" max="<?php echo$row['stock']; ?>" value="1">
                                        <button class="btn btn-sm btn-success do_add_to_cart" data-id="<?php echo $row['id'];?>">
                                            <i class="fas fa-plus"></i> Agregar al carrito
                                        </button>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.33.1/dist/sweetalert2.all.min.js"></script>

    <!-- Waitme -->
    <script src="Home_estilos/waitMe.min.js"></script>


</body>
</html>
