<?php
    session_start();
    $nombre_s = $_SESSION['nombreUser'];
    if (empty($nombre_s)) {
        header("Location: ../index.php"); 
        exit(); 
    }
?>
<html>
<head>    
    <title>Lista de pedidos</title>
    
    <link rel="stylesheet" type="text/css" href="../Admin_Estilos/estilo2.css">

    <script src="../Admin_Funciones/Jquery_lib.js"></script>
    
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
<div class="escritura">Lista de pedidos<br><hr></div><br>

<br><table border=2 align="center" valign="middle" id="tabla-empleados">
    <tr>
        <th colspan="7" align="center" valign="middle" height="50">Lista de empleados</th>
    </tr>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Fecha</th>
        <th scope="col">id_cliente</th>
        <th scope="col">status</th>
        <th scope="col"></th>
    </tr>


<?php
//empleados_lista.php
require "../Admin_Funciones/conecta.php";
$con = conecta();

$sql = "SELECT * FROM pedidos WHERE status = 1";

$res = $con->query($sql);

$estado = array( 0=> "Abierto", 1=> "Cerrado");

while($row = $res->fetch_array()){
    $id        = $row["id"];
    $fecha    = $row["fecha"];
    $id_cliente = $row["id_cliente"];
    $est       = $row["status"];

    $sit = $estado[$est];

?>
    <tr class="fila">
        <td height="10%" width="10%" align="center" valign="middle"><?php echo $id; ?></td>
        <td height="40%" width="40%" align="center" valign="middle"><?php echo $fecha; ?></td>
        <td height="40%" width="40%" align="center" valign="middle"><?php echo $id_cliente; ?></td>
        <td height="50%" width="50%" align="center" valign="middle"><?php echo $sit; ?></td>
        
        <td><ul><li class="elimina detalle" data-id="<?php echo $id; ?>">Ver Detalle</li></ul></td>
    </tr>

<?php
    }
?>
</table>

<script>
   $(document).ready(function () {
    $(".detalle").click(function(){
        var id = $(this).data("id");
        window.location.href = "pedidos_detalle.php?id=" + id;
    });
   
    });

            $(document).ready(function () {
                $(".inicio").click(function (event) {
                        event.preventDefault();
                        window.location.href = "../home.php";
                    });
                $(".empleados").click(function(event){
                    event.preventDefault();
                    window.location.href = "empleados_lista.php";
                });
                $(".productos").click(function(event){
                    event.preventDefault();
                    window.location.href = "../Productos/productos_lista.php";
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

</body>
</html>