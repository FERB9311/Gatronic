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
    $sql = "SELECT * FROM productos WHERE id = $id";
    $res = $con->query($sql);

    $row = $res->fetch_assoc();

    $nombre    = $row["nombre"];
    $codigo = $row["codigo"];
    $descripcion    = $row["descripcion"];
    $costo = $row["costo"];
    $stock = $row["stock"];
?>

<head>
    <title>Editar producto</title>
    <link rel="stylesheet" type="text/css" href="../Admin_Estilos/estilo2.css">
    <style>
        #mensaje{
            color: #f00;
            font-size: 26px;
        }
        input,
        select,
        textarea {
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
            window.location.href = "productos_lista.php";
          });
          
         });    

        function validar(id) {
            var nombre = document.getElementById("nombre").value;
            var codigo = document.getElementById("codigo").value;
            var descripcion = document.getElementById("descripcion").value;
            var costo = document.getElementById("costo").value;
            var stock = document.getElementById("stock").selectedIndex;
            var archivo = document.getElementById("archivo");
           

            if (nombre == '' || codigo == '' || descripcion == '' || costo == '' || stock == '') {
                $('#mensaje').html('Faltan campos por llenar');
                setTimeout("$('#mensaje').html('')", 3000);
        
            }
            else{

                if (archivo.files.length > 0) {
                    document.getElementById("archivo_n").value = archivo.files[0].name;
                }

                document.Forma1.method = 'post';
                document.Forma1.action = 'productos_actualizar.php?id=' + id;
                document.Forma1.submit();
            }

        }

        
        function sale(){
            $.ajax({
                url: '../Admin_Funciones/verificar codigo.php', 
                method: 'POST',
                data: { codigo: $('#codigo').val() },
                dataType: 'json',
                success: function (res) {
                console.log('Número de filas:', res.count);
                if (res.count == 1 && res.codigo != '<?php echo $codigo ?>') {
                    $('#codigo').val('');
                    $('#mensaje').html('El codigo ' + res.codigo + ' ya existe');
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
   
<div class="escritura">Editar productos<br><hr></div><br>

<br><div>
    <a href="#" style="--clr:#1e9bff">
        <span id="lista">Regresar al listado</span><l></l>
    </a>
</div><br><br>

<form name="Forma1" enctype="multipart/form-data" id="Forma1">
    <input type="text" name="nombre" id="nombre" value="<?php echo "$nombre" ?>" placeholder="Nombre"/><br/>
    <input onblur="sale();" type="text" name="codigo" id="codigo" value="<?php echo "$codigo" ?>" placeholder="Código"/><br/>
    <textarea name="descripcion" id="descripcion" placeholder="Descripción"><?php echo $descripcion; ?></textarea><br/>
    <input type="text" name="costo" id="costo" value="<?php echo "$costo" ?>" placeholder="Costo"/><br/>
    <input type="text" name="stock" id="stock" value="<?php echo "$stock" ?>" placeholder="Stock"/><br/>

    <input type="file" id="archivo" name="archivo"><br><br>
    <input type="hidden" id="archivo_n" name="archivo_n" value="">

    <br><div id="mensaje" ></div><br>
    <ul><li class="elimina" id="send" onclick="validar(<?php echo $id;?>)">SEND</li></ul>
    
</form>


</body>

</html>