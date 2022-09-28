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
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="http://code.jquery.com/jquery-2.1.1.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="funciones.js"></script>
    <title>Catalogos</title>
</head>
<body class="body-bg">
    <?php
        include("../Includes/php/menu.php");
    ?>
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
                    <h1 class="form-titulo__tabla">Catalogos</h1>
                    <br><br>
                    <div class="form-contenedor__row">
                        <div class="contenedor-checkbox">
                            <input type="checkbox" class="form-checkbox" name="" id="check_altas" onClick="Muestra1()">
                            <span>Altas</span>
                        </div>
                        <div class="contenedor-checkbox">
                            <input type="checkbox" class="form-checkbox" name="" id="check_modificaciones" onClick="Muestra2()">
                            <span>Modificacions</span>
                        </div>
                        <div class="contenedor-checkbox">
                            <input type="checkbox" class="form-checkbox" name="" id="check_bajas" onClick="Muestra3()">
                            <span>Eliminaciones</span>
                        </div>
                    </div>
                    <br>
                    <div id="div_catalogos">
                        <span> Catalogo: &nbsp;</span>
                        <select name="" id="catalogos" class="form__select-esp" onChange="Procesa()">
                            <option value="0"> -- SELECCIONE --</option> 
                            <option value="1">Productos</option>
                            <option value="2">Departamentos</option>
                        </select>
                    </div>
                <br>
                <div id="mustra_formularios">

                </div>
                <br>
                <div id="muestra_resultados">

                </div>
                </div>
            </form>
            <div class="contenedor-descarga">
                <!-- <img src="../asset/imgs/login/login_mes_actual.gif" alt=""> -->
            </div>
            <div id="resultado" class="contenedor-descarga">

            </div>
            <div class="border"></div>
            <footer class="footer"></footer>
        </div>
    </section>
</body>
<script src="../asset/js/sidebar.js"></script>
</html>
