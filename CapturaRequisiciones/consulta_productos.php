<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <!-- <link rel="shortcut icon" href="../constantes/asset/imgs/favicon.png" type="image/png" />
	<link rel="stylesheet" href="../constantes/asset/css/style.css"> -->
    <link rel="shortcut icon" href="../asset/imgs/favicon.png" type="image/png">
    <link rel="stylesheet" href="../asset/css/style.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="http://code.jquery.com/jquery-2.1.1.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="funciones.js"></script>
    <?php
    include("../Includes/connection.php");

    $consulta = "SELECT * FROM CREQ_PRODUCTOS";
	$resultado = mysqli_query($con, $consulta);
   
   
    ?>
    <title>Catalogo de Productos</title>
</head>
<body class="body-bg">
    <div class="body-d">
        <img src="../asset/imgs/logo_mes_actual.jpg" class="form-logo" />
		<div class="border"></div>
        <div id="resultado" class="contenedor-descarga">
            <br><br>
            <h3 class="form-h3__tabla">Catalogo de Productos:</h3>
            <br>
            <table class="tabla-mes">
                <tr>
                    <th class="tabla-mes__head">Nombre</th>
                    <th class="tabla-mes__head">Precio Unitario</th>
                </tr>
            <?php
            while($fila = mysqli_fetch_array($resultado)){
                $nombre = $fila['NOMBRE'];
                $precio_unitario = $fila["PRECIO"];
            ?>
                <tr>
                    <th class="tabla-mes"><?php echo $nombre; ?></th>
                    <th class="tabla-mes"><?php echo "$ ".$precio_unitario; ?></th>
                </tr>
            <?php
            }
            ?>
            </table>
            <br><br>
        </div>
        <div class="border"></div>
        <footer class="footer"></footer>
    </div>
</body>
</html>
