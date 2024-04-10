<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f4f4f4; 
        }

        .container {
            max-width: 1200px;
            margin: 0 auto; 
        }

        header {
            background-color: white; 
            color: dodgerblue; 
            padding: 10px;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0px 4px 5px dodgerblue; 
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center; 
            background-color: white; 
            overflow: hidden;
        }

        nav li {
            margin: 0 10px; 
        }

        nav a {
            display: block;
            color: black; 
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            transition: color 0.3s, background-color 0.3s; 
        }

        nav a:hover {
            background-color: dodgerblue; 
            color: white; 
        }

        img.logo {
            cursor: pointer; 
        }
    </style>
</head>
<body>

<div class="container">
    <header>
        <div>
            <a href="../Admin/index.php">
                <img class="logo" src="Home_Archivos/logo.png" alt="Logo" width="100" height="100">
            </a>
        </div>

        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="productos.php">Productos</a></li>
                <li><a href="contacto.php">Contacto</a></li>
                

                <?php
                if (isset($_SESSION['nombreUserc'])) {
                    echo '<li><a href="carrito1.php">Carrito</a></li>';
                    echo '<li><a href="Home_Funciones/cerrar_sesion.php">Cerrar sesión</a></li>';
                } else {
                    echo '<li><a href="inicio_sesion.php">Iniciar sesión</a></li>';
                }
                ?>
            </ul>
        </nav>
    </header>
</div>

</body>
</html>
