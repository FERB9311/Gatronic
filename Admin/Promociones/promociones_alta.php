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
    <title>Alta promociones</title>
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
            window.location.href = "promociones_lista.php";
          });
          
         });    

        function validar() {
            var nombre = document.getElementById("nombre").value;
            
            var archivo = document.getElementById("archivo");

            if (nombre == '' || archivo.files.length <= 0) {
                $('#mensaje').html('Faltan campos por llenar');
                setTimeout("$('#mensaje').html('')", 3000);
        
            }
            else{

                document.getElementById("archivo_n").value = archivo.files[0].name;

                document.Forma1.method = 'post';
                document.Forma1.action = 'promociones_salva.php';
                document.Forma1.submit();
            }

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
                window.location.href = "../Productos/productos_lista.php";
            });
            $(".promociones").click(function(event){
                event.preventDefault();
                window.location.href = "promociones_lista.php";
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
<div class="escritura">Alta de promociones<br><hr></div><br>

<br><div>
    <a href="#" style="--clr:#1e9bff">
        <span id="lista">Regresar al listado</span><l></l>
    </a>
</div><br><br>

<form name="Forma1" enctype="multipart/form-data" id="Forma1">
    <input type="text" name="nombre" id="nombre" placeholder="Nombre"/><br/>

    <input type="file" id="archivo" name="archivo"><br><br>
    <input type="hidden" id="archivo_n" name="archivo_n" value="">

    <br><div id="mensaje" ></div><br>
    <ul><li class="elimina" id="send" onclick="validar()">SEND</li></ul>
    
</form>

</body>

</html>