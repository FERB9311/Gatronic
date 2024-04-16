<?php session_start(); ?>
<html>
    <head>
        <title>Contacto</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="Home_estilos/bootstrap.min.css">
        <!-- font awesome -->
        <link rel="stylesheet" href="http://use.fontawesome.com/releases/v5.6.3/css/all.css">
        <!-- Waitme -->
        <link rel="stylesheet" href="Home_estilos/waitMe.min.css">
    </head>

    <body>
        <?php include "Home_Funciones/header.php" ?>
         
        <!-- Contenido -->
        <div class="container">
            <div id="contacto">
                <ul>
                    <li class="google-maps"><!-- maps --></li>
                    <li class="formulario">
                        <h3>Déjanos un mensaje</h3>
                        <form action="procesos/submit.php" method="POST">
                            <input type="name" name="nombre" placeholder="Tu nombre">
                            <input type="email" name="email" placeholder="Tu e-mail">
                            <input type="tel" name="tel" placeholder="Tu teléfono">
                            <textarea name="mensaje" placeholder="Tu mensaje..."></textarea>
                            <button type="submit" name="submit" class="black">Enviar mensaje</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Footer -->
        <div class="container-fluid bg-light py-5">
            <footer id="footer">
                <div class="row">
                    <div class="col-xl-4">
                        <ul class="list-unstyled">
                            <li><a href="#">Instagram</a></li>
                            <li><a href="#">Facebook</a></li>
                            <li><a href="#">Twitter</a></li>
                        </ul>
                    </div>
                    <div class="col-xl-4">
                        <ul class="list-unstyled">
                            <li><a href="#">Inicio</a></li>
                            <li><a href="#">Productos</a></li>
                            <li><a href="#">Contacto</a></li>
                            <li><a href="#">Derechos reservados</a></li>
                            <li><a href="#">Términos y condiciones</a></li>
                        </ul>
                    </div>
                    <div class="col-xl-4">
                        <p>Desarrollado por <a href="#">Gatronic</a></p>
                    </div>
                </div>
            </footer>
        </div>


       

        <!-- Bootstrap -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

        <!-- sweet alert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.33.1/dist/sweetalert2.all.min.js"></script>

        <!-- Waitme -->
        <script src="Home_estilos/waitMe.min.js"></script>

    </body>

</html>