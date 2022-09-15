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
    <script src="http://code.jquery.com/jquery-2.1.1.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="funciones.js"></script>
    <?php
    include("../Includes/connection.php");
    $requisicion = $_GET['requisicion'];
    
    $consulta_requisicion_general = "SELECT * FROM CREQ_REQUISICIONES_GENERAL WHERE CLAVE_REQUISICION = '".$requisicion."'";
    $ejecuta_requisicion_general = mysqli_query($con, $consulta_requisicion_general);
    $row=mysqli_fetch_assoc($ejecuta_requisicion_general);
    $departamento=$row['DEPARTAMENTO'];
    $patente=$row['PATENTE'];
    $prioridad=$row['PRIORIDAD'];
    $observaciones_adicionales=$row['COMENTARIOS_ADICIONALES'];

    $consulta_departamento = "SELECT * FROM CREQ_DEPARTAMENTOS WHERE ID = ".$departamento;
    $ejecuta_consulta_departamento = mysqli_query($con, $consulta_departamento);
    $row2=mysqli_fetch_assoc($ejecuta_consulta_departamento);
    $nombre_departamento=$row2['NOMBRE'];

    $consulta_requisicion_detalle = "SELECT * FROM CREQ_REQUISICIONES_DETALLE WHERE CLAVE_REQUISICION = '".$requisicion."'";
    $ejecuta_requisicion_detalle = mysqli_query($con, $consulta_requisicion_detalle);

    ?>
    <title>Consulta Detalles</title>
</head>
<body>
<body class="body-bg">
    <div class="body-d">
        <img src="../asset/imgs/logo_mes_actual.jpg" class="form-logo" />
		<div class="border"></div>
        <div id="resultado" class="contenedor-descarga">
            <br> 
            <h3 class="form-h3__tabla">DETALLE REQUISICIONES CAPTURADAS:</h3>
            <br>
                <div>
                    <span> Departamento: &nbsp;</span>
                    <input type="text" placeholder="Ingrese información" class="form__text-validador" style="width: 200px;" value="<?php echo $nombre_departamento; ?>" disabled>
                </div>
                <br>
                <div>
                    <span> Patente: &nbsp;</span>
                    <input type="text" placeholder="Ingrese información" class="form__text-validador" style="width: 200px;" value="<?php echo $patente; ?>" disabled>
                </div>
                <br>
                <div>
                    <span> Prioridad: &nbsp;</span>
                    <input type="text" placeholder="Ingrese información" class="form__text-validador" style="width: 200px;" value="<?php echo $prioridad; ?>" disabled>
                </div>
                <br>
                <table class="tabla-mes">
                <tr>
                    <th class="tabla-mes__head">PRODUCTO</th>
                    <th class="tabla-mes__head">CANTIDAD</th>
                    <th class="tabla-mes__head">PRECIO UNITARIO</th>
                    <th class="tabla-mes__head">OBSERVACIONES</th>
                    <th class="tabla-mes__head">BITACORA ENTREGA</th>
                </tr>
                <?php
                while($row3=mysqli_fetch_assoc($ejecuta_requisicion_detalle)){
                    $clave_producto=$row3['CLAVE_PRODUCTO'];
                    $cantidad=$row3['CANTIDAD_PRODUCTO'];
                    $observaciones=$row3['OBSERVACIONES'];

                    $consulta_producto = "SELECT * FROM CREQ_PRODUCTOS WHERE ID = ".$clave_producto;
                    $ejecuta_consulta_producto = mysqli_query($con, $consulta_producto);
                    $row4=mysqli_fetch_assoc($ejecuta_consulta_producto);
                    $nombre_producto=$row4['NOMBRE'];
                    $precio_unitario=$row4['PRECIO'];
                ?>
                    <tr>
                        <th class="tabla-mes"><?php echo $nombre_producto; ?></th>
                        <th class="tabla-mes"><?php echo $cantidad; ?></th>
                        <th class="tabla-mes"><?php echo "$".$precio_unitario; ?></th>
                        <th class="tabla-mes"><?php echo $observaciones; ?></th>
                        <th class="tabla-mes">
                            <table class="tabla-mes">
                                <tr>
                                    <th class="tabla-mes__head">CANTIDAD ENTREGADA</th>
                                    <th class="tabla-mes__head">FECHA ENTREGA</th>
                                </tr>
                                <?php
                                    $consulta_bitacora_entregas = "SELECT * FROM CREQ_BITACORA_ENTREGAS WHERE CLAVE_REQUISICION = '".$requisicion."' AND CLAVE_PRODUCTO = ".$clave_producto;
                                    $ejecuta_bitacora_entregas = mysqli_query($con, $consulta_bitacora_entregas);
                                    while($row5=mysqli_fetch_assoc($ejecuta_bitacora_entregas)){
                                        $cantidad_entregada=$row5['CANTIDAD_ENTREGADA'];
                                        $fecha_entrega=$row5['FECHA_ENTREGA'];
                                        ?>
                                            <tr class="tabla-mes">
                                                <th class="tabla-mes"><?php echo $cantidad_entregada; ?></th>
                                                <th class="tabla-mes"><?php echo $fecha_entrega; ?></th>
                                            </tr>
                                        <?php
                                    }
                                ?>
                                </table>
                        </th>
                    </tr>
                <?php
                }
                ?>
                </table>
                <br>
                <span> Comentarios Adicionales: &nbsp;</span>
                <div>
                    <textarea class="form__textarea" style="width: 100%;" name="" id="" cols="30" rows="10" disabled><?php echo $observaciones_adicionales; ?></textarea>
                </div>
        </div>
        <div class="border"></div>
        <footer class="footer"></footer>
    </div>
</body>
</html>