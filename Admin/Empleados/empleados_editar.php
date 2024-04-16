<?php
    session_start();
    $nombre_s = $_SESSION['nombreUser'];
    if (empty($nombre_s)) {
        header("Location: ../index.php"); 
        exit(); 
    }
?>
<html>
<?php
    require "../Admin_Funciones/conecta.php";
    $con = conecta();
    $id = $_REQUEST['id'];
    $sql = "SELECT * FROM empleados WHERE id = $id";
    $res = $con->query($sql);

    $row = $res->fetch_assoc();

    $nombre    = $row["nombre"];
    $apellidos = $row["apellidos"];
    $correo    = $row["correo"];
?>

<head>
    <title>Editar empleado</title>
    <link rel="stylesheet" type="text/css" href="../Admin_Estilos/estilo2.css">
    <style>
        #mensaje{
            color: #f00;
            font-size: 26px;
        }
        input,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        select {
            cursor: pointer;
        }


    </style>
    <script src="../Admin_Funciones/Jquery_lib.js"></script>
    <script>
        $(function (){
           $('#lista').click(function(){
            window.location.href = "empleados_lista.php";
          });
          
         });    

        function validar(id) {
            var nombre = document.getElementById("nombre").value;
            var apellidos = document.getElementById("apellidos").value;
            var correo = document.getElementById("correo").value;
            var pass = document.getElementById("pass").value;
            var rol = document.getElementById("rol").selectedIndex;
            var archivo = document.getElementById("archivo");
           

            if (nombre == '' || apellidos == '' || correo == '' || rol == 0) {
                $('#mensaje').html('Faltan campos por llenar');
                setTimeout("$('#mensaje').html('')", 3000);
        
            }
            else{

                if (archivo.files.length > 0) {
                    document.getElementById("archivo_n").value = archivo.files[0].name;
                }

                document.Forma1.method = 'post';
                document.Forma1.action = 'empleados_actualizar.php?id=' + id;
                document.Forma1.submit();
            }

        }

        
        function sale(){
            $.ajax({
                url: '../Admin_Funciones/verificar correo.php', 
                method: 'POST',
                data: { correo: $('#correo').val() },
                dataType: 'json',
            success: function (res) {
                console.log('Número de filas:', res.count);
                if (res.count == 1 && res.correo != '<?php echo $correo ?>') {
                    $('#correo').val('');
                    $('#mensaje').html('El correo ' + res.correo + ' ya existe');
                    setTimeout("$('#mensaje').html('')", 5000);

                }
            },      
            });
            }

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
<div class="escritura">Editar empleados<br><hr></div><br>

<br><div>
    <a href="#" style="--clr:#1e9bff">
        <span id="lista">Regresar al listado</span><l></l>
    </a>
</div><br><br>

<form name="Forma1" enctype="multipart/form-data" id="Forma1">
    <input type="text" name="nombre" id="nombre" value="<?php echo "$nombre" ?>" placeholder="Nombre"/><br/>
    <input type="text" name="apellidos" id="apellidos" value="<?php echo "$apellidos" ?>" placeholder="Apellidos"/><br/>
    <input onblur="sale();" type="text" name="correo" id="correo" value="<?php echo "$correo" ?>" placeholder="Correo"/><br/>
    <input type="text" name="pass" id="pass" placeholder="Password"/><br/>
    <select name="rol" id="rol">
        <option value="0">Selecciona...</option>
        <option value="1">Gerente.</option>
        <option value="2">Ejecutivo.</option>
    </select><br/>

    <input type="file" id="archivo" name="archivo"><br><br>
    <input type="hidden" id="archivo_n" name="archivo_n" value="">

    <br><div id="mensaje" ></div><br>
    <ul><li class="elimina" id="send" onclick="validar(<?php echo $id;?>)">SEND</li></ul>
    
</form>


</body>

</html>