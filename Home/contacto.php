<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="Home_estilos/bootstrap.min.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="http://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <!-- Waitme -->
    <link rel="stylesheet" href="Home_estilos/waitMe.min.css">
    <!-- Estilos personalizados -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        #contacto {
            margin-top: 50px;
        }
        .formulario {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .formulario h3 {
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }
        .formulario input[type="text"],
        .formulario input[type="email"],
        .formulario input[type="tel"],
        .formulario textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        .formulario textarea {
            height: 150px;
        }
        .formulario button {
            background-color: #007bff;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .formulario button:hover {
            background-color: #0056b3;
        }
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <?php include "Home_Funciones/header.php" ?>
     
    <!-- Contenido -->
    <div class="container">
        <div id="contacto" class="row">
            <div class="col-md-6 order-md-last">
                <div class="formulario">
                    <h3>Déjanos un mensaje</h3>
                    <form action="Home_Funciones/submit.php" method="POST">
                        <input type="text" name="nombre" placeholder="Tu nombre" required>
                        <input type="email" name="email" placeholder="Tu e-mail" required>
                        <input type="tel" name="tel" placeholder="Tu teléfono">
                        <textarea name="mensaje" placeholder="Tu mensaje..." required></textarea>
                        <button type="submit" name="submit">Enviar mensaje</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6 order-md-first">
                <div class="logo">
                    <img src="Home_Archivos/logo.png" alt="Logo">
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="container-fluid bg-light py-5">
        <footer id="footer">
            <div class="row">
                <div class="col-xl-4 footer-links">
                    <ul>
                        <li><a href="#">Instagram</a></li>
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Twitter</a></li>
                    </ul>
                </div>
                <div class="col-xl-4 footer-links">
                    <ul>
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
