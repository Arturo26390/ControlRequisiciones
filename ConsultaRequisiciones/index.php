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
    <style type="text/css">
    ul.paginador
    {
        
    }
    ul.paginador li
    {
        float:left;
        width: 40px;;
    }
    ul.paginador li a
    {
        float:left;
        width: 40px;
    }
    ul.paginador li.paginador-active a, ul.paginador li a:hover
    {
        background-color: #F25C05;
        border-color: #337ab7;
        color:#FFFFFF;
        width: 40px;
    }
    ul.paginador li.paginador-disabled a, ul.paginador li.paginador-disabled a:hover
    {
        cursor:default;
        width: 40px;
    }
    ul.paginador li.paginador-current
    {
        width: 140px;
    }
    </style>
    <?php
    include("../Includes/connection.php");
    ?>
    <title>Catalogo de Productos</title>
</head>
<body>
<body class="body-bg">
    <div class="body-d">
        <img src="../asset/imgs/logo_mes_actual.jpg" class="form-logo" />
		<div class="border"></div>
        <div id="resultado" class="contenedor-descarga">
            <br> 
            <h3 class="form-h3__tabla">REQUISICIONES CAPTURADAS:</h3>
            <br>
                <table width="90%" border="0" cellspacing="3" cellpadding="0" class="tabla-mes">
                    <tr>
                        <th class="tabla-mes__head">Clave</th>
                        <th class="tabla-mes__head">Fecha Captura</th>
                        <th class="tabla-mes__head">Usuario Captura</th>
                        <th class="tabla-mes__head">Patente</th>
                        <th class="tabla-mes__head">Prioridad</th>
                        <th class="tabla-mes__head">Departamento</th>
                    </tr>
                    <?php
                    include("class.pagina.php");
                    $sql = "SELECT CLAVE_REQUISICION,FECHA_CAPTURA,USUARIO_CAPTURA,PATENTE,PRIORIDAD,DEPARTAMENTO FROM CREQ_REQUISICIONES_GENERAL";
                    $PAGINADOR=new PAGINADOR($sql,$con);
                    
                    $sql=$PAGINADOR->sql;
                    
                    $res=mysqli_query($con, $sql);
                    while($row=mysqli_fetch_array($res))
                    {

                        $consulta_usuarios = "SELECT * FROM CREQ_USUARIOS WHERE CLAVE = '".$row[2]."'";
                        $ejecuta_consulta_usuarios =  mysqli_query($con, $consulta_usuarios);
                        $fila_usuarios = mysqli_fetch_array($ejecuta_consulta_usuarios);
                        $nombre_usuario = $fila_usuarios["NOMBRE"];
        
                        $consulta_areas = "SELECT * FROM CREQ_DEPARTAMENTOS WHERE ID = '".$row[5]."'";
                        $ejecuta_consulta_areas =  mysqli_query($con, $consulta_areas);
                        $fila_areas = mysqli_fetch_array($ejecuta_consulta_areas);
                        $nombre_departamento = $fila_areas["NOMBRE"];
                    ?>
                    <tr>
                        <td class="tabla-mes"><a href="../Requisiciones-PDF/<?php echo $row[0]; ?>.pdf" target="_blank"><?php echo $row[0]?></a></td>
                        <td class="tabla-mes"><?php echo $row[1]?></td>
                        <td class="tabla-mes"><?php echo $nombre_usuario?></td>
                        <td class="tabla-mes"><?php echo $row[3]?></td>
                        <td class="tabla-mes"><?php echo $row[4]?></td>
                        <td class="tabla-mes"><?php echo  $nombre_departamento?></td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
            <hr />
            <br>
            <div><?php echo $PAGINADOR->ver_pagina("index2.php")?></div>
        </div>
        <div class="border"></div>
        <footer class="footer"></footer>
    </div>
</body>
</html>