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
    <title>Lista de empleados</title>
    
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
<div class="escritura">Lista de empleados<br><hr></div><br>

<br><div>
    <a href="#" style="--clr:#1e9bff">
        <span id="nuevo">Dar de alta</span><l></l>
    </a>
</div><br>



<br><table border=2 align="center" valign="middle" id="tabla-empleados">
    <tr>
        <th colspan="7" align="center" valign="middle" height="50">Lista de empleados</th>
    </tr>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre Completo</th>
        <th scope="col">Correo</th>
        <th scope="col">Rol</th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
    </tr>


<?php
//empleados_lista.php
require "../Admin_Funciones/conecta.php";
$con = conecta();

$sql = "SELECT * FROM empleados WHERE status = 1 AND eliminado = 0";

$res = $con->query($sql);

$roles = array( 1=> "Gerente", 2=> "Ejecutivo");

while($row = $res->fetch_array()){
    $id        = $row["id"];
    $nombre    = $row["nombre"];
    $apellidos = $row["apellidos"];
    $correo    = $row["correo"];
    $rolNum       = $row["rol"];

    $rol = $roles[$rolNum];

?>
    <tr class="fila">
        <td height="10%" width="10%" align="center" valign="middle"><?php echo $id; ?></td>
        <td height="40%" width="40%" align="center" valign="middle"><?php echo $nombre . " " . $apellidos; ?></td>
        <td height="40%" width="40%" align="center" valign="middle"><?php echo $correo; ?></td>
        <td height="50%" width="50%" align="center" valign="middle"><?php echo $rol; ?></td>
        <td align="center" valign="middle">
            <ul><li class="elimina" id="eliminar" data-id="<?php echo $id; ?>">Eliminar</li></ul> 
        </td>
        <td><ul><li class="elimina detalle" data-id="<?php echo $id; ?>">Ver Detalle</li></ul></td>
        <td><ul><li class="elimina editar" data-id="<?php echo $id; ?>">Editar</li></ul></td>  
    </tr>

<?php
    }
?>
</table>

<script>
   $(document).ready(function () {
    $("#nuevo").click(function (event) {
            event.preventDefault();
            window.location.href = "empleados_alta.php";
        });
    $(".detalle").click(function(){
        var id = $(this).data("id");
        window.location.href = "empleados_detalle.php?id=" + id;
    });
    $(".editar").click(function(){
        var id = $(this).data("id");
        window.location.href = "empleados_editar.php?id=" + id;
    });

    $("#eliminar").click(function () {
        var $elemento = $(this);
        var id = $(this).data("id");
        var confirmar = confirm("¿Eliminar empleado?");

        if (confirmar) {
            $.ajax({
                url: "empleados_elimina.php",
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
                    window.location.href = "../Pedidos/";
                });
                $(".cerrar").click(function(event){
                    event.preventDefault();
                    window.location.href = "../Admin_Funciones/cerrar_sesion.php";
                });
            });

</script>

</body>
</html>