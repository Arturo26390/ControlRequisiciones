<!DOCTYPE html>
<html>
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
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="http://code.jquery.com/jquery-2.1.1.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="funciones.js"></script>
    <?php
    include("../Includes/connection.php");
    ?>
    <title>Cambia Estatus</title>
</head>
<body class="body-bg">
    <div class="sidebar">
        <div class="logo-details">
            <i class='bx bx-scatter-chart'></i>
            <span class="logo__name">Cambia Aprobadas</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="../CapturaRequisiciones/index.php">
                    <i class='bx bx-grid-alt'></i>
                    <span class="link__name">Captura Requisicion</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-collection'></i>
                    <span class="link__name">Consulta Requisiciones</span>
                </a>
            </li>
            <li>
                <a href="../CambiaAprobadas/index.php">
                    <i class='bx bx-scatter-chart'></i>
                    <span class="link__name">Cambia Aprobadas</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxl-netlify'></i>
                    <span class="link__name">Seguimiento</span>
                </a>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu menu-hamburguesa'></i>
            <span class="home-section__text">Menu</span>
        </div>
        <div class="body-d">
            <img src="../asset/imgs/logo_mes_actual.jpg" class="form-logo" />
            <div class="border"></div>
                <form action="" class="form">
                    <div class="contenedor-div">
                        <br>
                        <h1 class="form-titulo__tabla">Cambia Estatus</h1>
                        <br><br>
                        <div>
                            <span> Fecha: &nbsp;</span>
                            <input type="date" id="fecha_requi" class="form__date" style="width: 200px;" onChange="consultaRequis()">
                        </div>
                        <br>
                        <div id="muestra_tabla" class="contenedor-descarga"></div>
                        <br>
                        <div id="muestra_detalle" class="contenedor-descarga"></div>    
                    </div>
            </form>
            <div class="border"></div>
            <footer class="footer"></footer>
        </div>
    </section>
</body>
<script src="../asset/js/sidebar.js"></script>
</html>