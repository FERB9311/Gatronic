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
    <title>Lista de promociones</title>
    
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
        </table><br>
<div class="escritura">Lista de promociones<br><hr></div><br>

<br><div>
    <a href="#" style="--clr:#1e9bff">
        <span id="nuevo">Dar de alta</span><l></l>
    </a>
</div><br>



<br><table border=2 align="center" valign="middle" id="tabla-promociones">
    <tr>
        <th colspan="4" align="center" valign="middle" height="50">Lista de promociones</th>
    </tr>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col"></th>
        <th scope="col"></th>
        
    </tr>


<?php
//empleados_lista.php
require "../Admin_Funciones/conecta.php";
$con = conecta();

$sql = "SELECT * FROM promociones WHERE status = 1 AND eliminado = 0";

$res = $con->query($sql);


while($row = $res->fetch_array()){
    $id        = $row["id"];
    $nombre    = $row["nombre"];

?>
    <tr class="fila">
        <td height="10%" width="10%" align="center" valign="middle"><?php echo $id; ?></td>
        <td height="40%" width="90%" align="center" valign="middle"><?php echo $nombre; ?></td>
        <td align="center" valign="middle">
            <ul><li class="eliminar" id="eliminar" data-id="<?php echo $id; ?>">Eliminar</li></ul> 
        </td>
        <td><ul><li class="elimina detalle" data-id="<?php echo $id; ?>">Ver Detalle</li></ul></td> 
    </tr>

<?php
    }
?>
</table>

<script>
   $(document).ready(function () {
    $("#nuevo").click(function (event) {
            event.preventDefault();
            window.location.href = "promociones_alta.php";
        });
    $(".detalle").click(function(){
        var id = $(this).data("id");
        window.location.href = "promociones_detalle.php?id=" + id;
    });

    $(".eliminar").click(function () {
        var $elemento = $(this);
        var id = $(this).data("id");
        var confirmar = confirm("¿Eliminar promoción?");

        if (confirmar) {
            $.ajax({
                url: "promociones_elimina.php",
                method: "POST",
                data: { id: id },
                dataType: 'json',
                success: function (res) {
                    if (res.success) {
                        console.log(res);
                        $elemento.closest("tr").remove();
                    } else {
                        alert("Error al eliminar.");
                    }
                },
                error: function () {
                    alert("Error al eliminar.");
                }
            });
        }
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
                window.location.href = "../Productos/productos_lista.php";
            });
            $(".promociones").click(function(event){
                event.preventDefault();
                window.location.href = "promociones_lista.php";
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