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
    <title>Alta Productos</title>
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

        function validar() {
            var nombre = document.getElementById("nombre").value;
            var codigo = document.getElementById("codigo").value;
            var descripcion = document.getElementById("descripcion").value;
            var costo = document.getElementById("costo").value;
            var stock = document.getElementById("stock").selectedIndex;
            var archivo = document.getElementById("archivo");

            if (nombre == '' || codigo == '' || descripcion == '' || costo == '' || stock == 0 || archivo.files.length <= 0) {
                $('#mensaje').html('Faltan campos por llenar');
                setTimeout("$('#mensaje').html('')", 3000);
        
            }
            else{

                document.getElementById("archivo_n").value = archivo.files[0].name;

                document.Forma1.method = 'post';
                document.Forma1.action = 'productos_salva.php';
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
                if (res.count == 1) {
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
                window.location.href = "../Pedidos/";
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
<div class="escritura">Alta de productos<br><hr></div><br>

<br><div>
    <a href="#" style="--clr:#1e9bff">
        <span id="lista">Regresar al listado</span><l></l>
    </a>
</div><br><br>

<form name="Forma1" enctype="multipart/form-data" id="Forma1">
    <input type="text" name="nombre" id="nombre" placeholder="Nombre"/><br/>
    <input onblur="sale();" type="text" name="codigo" id="codigo" placeholder="Codigo"/><br/>
    <textarea name="descripcion" id="descripcion" placeholder="Descripcion"></textarea><br/>
    <input type="text" name="costo" id="costo" placeholder="Costo"/><br/>
    <input type="text" name="stock" id="stock" placeholder="Stock"/><br/>

    <input type="file" id="archivo" name="archivo"><br><br>
    <input type="hidden" id="archivo_n" name="archivo_n" value="">

    <br><div id="mensaje" ></div><br>
    <ul><li class="elimina" id="send" onclick="validar()">SEND</li></ul>
    
</form>

</body>

</html>