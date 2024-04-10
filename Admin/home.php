<?php
    session_start();
    $nombre_s = $_SESSION['nombreUser'];
    if (empty($nombre_s)) {
        header("Location: index.php"); 
        exit(); 
    }
?>
<html>
    <head>
        <title>BIENVENIDO</title>
        <link rel="stylesheet" type="text/css" href="Admin_estilos/estilo2.css">
        <script src="Admin_Funciones/Jquery_lib.js"></script>
        <script>
            $(document).ready(function () {
                $(".inicio").click(function (event) {
                        event.preventDefault();
                        window.location.href = "home.php";
                    });
                $(".empleados").click(function(event){
                    event.preventDefault();
                    window.location.href = "Empleados/empleados_lista.php";
                });
                $(".productos").click(function(event){
                    event.preventDefault();
                    window.location.href = "Productos/productos_lista.php";
                });
                $(".promociones").click(function(event){
                    event.preventDefault();
                    window.location.href = "Promociones/promociones_lista.php";
                });
                $(".pedidos").click(function(event){
                    event.preventDefault();
                    window.location.href = "Pedidos/";
                });
                $(".cerrar").click(function(event){
                    event.preventDefault();
                    window.location.href = "Admin_Funciones/cerrar_sesion.php";
                });
            });
        </script>
    </head>
    <body>
        <table  align="center" valign="middle">
            <tr>
                <td scope="col"><img src="Admin_archivos/logo.png"  width="100" height="100"></td>
                <td colspan="4"style="font-size: 33px;">Bienvenido <?php echo $nombre_s; ?></td>
                <td scope="col"><img src="Admin_archivos/logo.png"  width="100" height="100"></td>
            </tr>
            <tr>
                
                <td scope="col"><ul><li class="inicio">Inicio</li></ul></td>
                <td scope="col"><ul><li class="empleados">Empleados</li></ul></td>
                <td scope="col"><ul><li class="productos">Productos</li></ul></td>
                <td scope="col"><ul><li class="promociones">Promociones</li></ul></td>
                <td scope="col"><ul><li class="pedidos">Pedidos</li></ul></td>
                <td scope="col"><ul><li class="cerrar">Cerrar sesión</li></ul></td>
                
            </tr>
        </table><br> 
        <div align="center">
            <img src="Admin_archivos/fondo.jpg" alt="Fondo">
        </div>   
    </body>
</html>
