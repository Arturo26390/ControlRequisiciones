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
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="http://code.jquery.com/jquery-2.1.1.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="funciones.js"></script>
    <title>Plantilla</title>
</head>
<body class="body-bg">
    <?php
        include("../Includes/php/menu.php");
    ?>
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
                    <h1 class="form-titulo__tabla">Captura Requisición</h1>
                    <br><br>
                    <div>
                        <span> Area: &nbsp;</span>
                        <select name="area" id="area" class="form__select-esp" required>
                            <option value="0">- SELECCIONE -</option>
                            <?php
                                $query3=mysqli_query($con, "SELECT * FROM CREQ_DEPARTAMENTOS");
                                while($row3=mysqli_fetch_assoc($query3))
                                {
                                    $nombre=$row3['NOMBRE'];
                                    $id=$row3['ID']; ?>
                                    <option value="<?php echo $id; ?>"><?php echo $nombre;?></option><?php
                                }
                            ?>
                        </select>
                    </div>
                    <br>
                    <div>
                        <span> Patente: &nbsp;</span>
                        <select name="patente" id="patente" class="form__select-esp" required>
                            <option value="0">-- SELECCIONE --</option>
                            <option value="3076">3076</option>
                            <option value="3694">3694</option>
                        </select>
                    </div>
                    <br>
                    <div>
                        <span> Prioridad: &nbsp;</span>
                        <select name="prioridad" id="prioridad" class="form__select-esp" required>
                            <option value="0">-- SELECCIONE --</option>
                            <option value="Alta">Alta</option>
                            <option value="Media">Media</option>
                            <option value="Baja">Baja</option>
                        </select>
                    </div>
                    <br>
                    <div>
                        <span> # de Productos: &nbsp;</span>
                        <input type="text" placeholder="Ingrese información" class="form__text-validador" style="width: 200px;" id="num_productos" onChange="GeneraProductos()" required>
                    </div>
                    <br>
                        <div id="resultado_num_productos" class="contenedor-descarga">
                    
                        </div>
                    <br><br>
                    <span>Comentarios Adicionales:</span>
                    <div>
                        <textarea class="form__textarea" style="width: 40%;" name="" id="comentarios" cols="30" rows="10"></textarea>
                    </div>
                    <br>
                    <div>
                        <button class="form__submit" type="button" id="procesar" onclick="agregaProducto()">Procesar</button>
                    </div>
                    <div id="muestra_mensaje">

                    </div>
                    <br>
                    <div id="resultadoPDF">

                    </div>
                </div>
            </form>
            <div class="border"></div>
            <footer class="footer"></footer>
        </div>
    </section>
</body>
<script src="../asset/js/sidebar.js"></script>
</html>