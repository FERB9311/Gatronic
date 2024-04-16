<?php
    session_start();
    $nombre_s = $_SESSION['nombreUser'];
    if (empty($nombre_s)) {
        header("Location: ../index.php"); 
        exit(); 
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" type="text/css" href="../Admin_Estilos/estilo2.css">
    <script src="../Admin_Funciones/Jquery_lib.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;    
        }

        .detalle-container {
            background-color: white;
            width: 60%;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            text-align: center;
        }

        .detalle-container img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-top: 20px;
        }
    </style>
    <script>
        $(function (){
           $('#lista').click(function(){
            window.location.href = "pedidos_lista.php";
          });
        });

        $(document).ready(function () {
            $(".inicio").click(function (event) {
                    event.preventDefault();
                    window.location.href = "../home.php";
                });
            $(".empleados").click(function(event){
                event.preventDefault();
                window.location.href = "../Empleados/empleados_lista.php";
            });
            $(".productos").click(function(event){
                event.preventDefault();
                window.location.href = "productos_lista.php";
            });
            $(".promociones").click(function(event){
                event.preventDefault();
                window.location.href = "../Promociones/promociones_lista.php";
            });
            $(".pedidos").click(function(event){
                event.preventDefault();
                window.location.href = "../Pedidos/pedidos_lista.php";
            });
            $(".cerrar").click(function(event){
                event.preventDefault();
                window.location.href = "../Admin_Funciones/cerrar_sesion.php";
            });
        });
    </script>
</head>
<body>
    <table  align="center" valign="middle">
                <tr>
                    <td scope="col"><img src="../Admin_archivos/logo.png"  width="100" height="100"></td>
                    <td colspan="4"style="font-size: 33px;">Bienvenido <?php echo $nombre_s; ?></td>
                    <td scope="col"><img src="../Admin_archivos/logo.png"  width="100" height="100"></td>
                </tr>
                <tr>
                    
                    <td scope="col"><ul><li class="inicio">Inicio</li></ul></td>
                    <td scope="col"><ul><li class="empleados">Empleados</li></ul></td>
                    <td scope="col"><ul><li class="productos">Productos</li></ul></td>
                    <td scope="col"><ul><li class="promociones">Promociones</li></ul></td>
                    <td scope="col"><ul><li class="pedidos">Pedidos</li></ul></td>
                    <td scope="col"><ul><li class="cerrar">Cerrar sesión</li></ul></td>
                    
                </tr>
            </table><br><br>
        <div class="escritura">Detalle del pedido<br><hr></div><br>

        <br><div>
            <a href="#" style="--clr:#1e9bff">
                <span id="lista">Regresar al listado</span><l></l>
            </a>
        </div><br><br>

        <br><table border=2 align="center" valign="middle" id="tabla-empleados">
        <tr>
            <th colspan="7" align="center" valign="middle" height="50">Detalle del pedido</th>
        </tr>
        <tr>
            <th scope="col">ID del producto</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Costo</th>
            
        </tr>


    <?php
    //empleados_lista.php
    require "../Admin_Funciones/conecta.php";
    $con = conecta();
    $id = $_REQUEST['id'];

    $sql = "SELECT * FROM pedidos_productos WHERE id_pedido = $id";

    $res = $con->query($sql);

    while($row = $res->fetch_array()){
        $id_producto        = $row["id_producto"];
        $cantidad    = $row["cantidad"];
        $precio = $row["precio"];
    ?>
        <tr class="fila">
            <td height="10%" width="10%" align="center" valign="middle"><?php echo $id_producto; ?></td>
            <td height="40%" width="40%" align="center" valign="middle"><?php echo $cantidad; ?></td>
            <td height="40%" width="40%" align="center" valign="middle"><?php echo "$ "; echo  $precio; ?></td>
        </tr>

    <?php
        }
    ?>
    </table>
</body>
</html>
