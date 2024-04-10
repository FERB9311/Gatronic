<?php
    session_start();

    if (isset($_SESSION['nombreUser'])) {
        header("Location: home.php");
        exit();
    }
?>
<html>
    <head>
        <title>INICIO</title>
        <link rel="stylesheet" type="text/css" href="Admin_estilos/estilo_index.css">
        <script src="Admin_Funciones/Jquery_lib.js"></script>
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
    </head>
    <body>
        <div class="login-box">
            <h2>Inicio de Sesión</h2>
            <h2>Sistema de Administración</h2>
            <form>
                <div class="user-box">
                    <input type="text" name="correo" required="" id="correo">
                    <label>Correo</label>
                </div>
                <div class="user-box">
                    <input type="password" name="password" required="" id="password">
                    <label>Contraseña</label>
                </div>
                <a href="#" class="inicio">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    INICIAR
                </a>
                <br><br><div id="mensaje" ></div><br>
            </form>
        </div>

        <script>
            $(function (){
                $('.inicio').on('click', function(e){
                    e.preventDefault(); 
                    validar();
                });

                function validar(){
                    var correo = $('#correo').val();
                    var password = $('#password').val();

                    if (correo === '' || password === '') {
                        $('#mensaje').html('Faltan campos por llenar');
                        setTimeout(function() {
                            $('#mensaje').html('');
                        }, 3000);            
                    } else {
                        console.log('Correo: ', correo);
                        $.ajax({
                            url: "Admin_Funciones/verificar_index.php",
                            method: "POST",
                            data: {
                                correo: correo,
                                password: password
                            },
                            dataType: 'json',
                            success: function(res) {
                                
                                console.log(res);
                                if (res == 0) {
                                    $('#mensaje').html('Usuario no válido');
                                    setTimeout(function() {
                                        $('#mensaje').html('');
                                    }, 3000);
                                } else {
                                    window.location.href = 'home.php';
                                }
                            },
                            error: function(err) {
                                
                                console.error('Error en la solicitud Ajax:', err);
                            }
                        });
                    }
                }
            });
        </script>
    </body>
</html>