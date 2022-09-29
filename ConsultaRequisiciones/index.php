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
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
    <title>Consulta Requisiciones</title>
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
            <div id="resultado" class="contenedor-descarga">
                <br> 
                <h3 class="form-h3__tabla">REQUISICIONES CAPTURADAS:</h3>
                <br>
                    <table width="90%" border="0" cellspacing="3" cellpadding="0" class="tabla-mes">
                        <tr>
                            <th class="tabla-mes__head">Clave</th>
                            <th class="tabla-mes__head">PDF</th>
                            <th class="tabla-mes__head">Fecha Captura</th>
                            <th class="tabla-mes__head">Usuario Captura</th>
                            <th class="tabla-mes__head">Fecha Aprobada</th>
                            <th class="tabla-mes__head">Fecha Completa</th>
                            <th class="tabla-mes__head">Fecha Cierre</th>
                            <th class="tabla-mes__head">Usuario Cierre</th>
                            <th class="tabla-mes__head">Patente</th>
                            <th class="tabla-mes__head">Prioridad</th>
                            <th class="tabla-mes__head">Departamento</th>
                        </tr>
                        <?php
                        include("class.pagina.php");
                        $sql = "SELECT CLAVE_REQUISICION,FECHA_CAPTURA,USUARIO_CAPTURA,FECHA_CIERRE,USUARIO_CIERRE,PATENTE,PRIORIDAD,DEPARTAMENTO,FECHA_APROBADA,FECHA_COMPLETA FROM CREQ_REQUISICIONES_GENERAL";
                        $PAGINADOR=new PAGINADOR($sql,$con);
                        
                        $sql=$PAGINADOR->sql;
                        
                        $res=mysqli_query($con, $sql);
                        while($row=mysqli_fetch_array($res))
                        {

                            $consulta_usuarios = "SELECT * FROM CREQ_USUARIOS WHERE USERNAME = '".$row[2]."'";
                            $ejecuta_consulta_usuarios =  mysqli_query($con, $consulta_usuarios);
                            $fila_usuarios = mysqli_fetch_array($ejecuta_consulta_usuarios);
                            $nombre_usuario = $fila_usuarios["NOMBRE"];

                            if($row[4] != ''){
                                $consulta_usuarios2 = "SELECT * FROM CREQ_USUARIOS WHERE USERNAME = '".$row[4]."'";
                                $ejecuta_consulta_usuarios2 =  mysqli_query($con, $consulta_usuarios2);
                                $fila_usuarios2 = mysqli_fetch_array($ejecuta_consulta_usuarios2);
                                $nombre_usuario2 = $fila_usuarios2["NOMBRE"];
                            }else{
                                $nombre_usuario2 = "";
                            }

                            $consulta_areas = "SELECT * FROM CREQ_DEPARTAMENTOS WHERE ID = '".$row[7]."'";
                            $ejecuta_consulta_areas =  mysqli_query($con, $consulta_areas);
                            $fila_areas = mysqli_fetch_array($ejecuta_consulta_areas);
                            $nombre_departamento = $fila_areas["NOMBRE"];

                            if($row[3] == '0000-00-00 00:00:00'){
                                $fecha_cierre = "";
                            }else{
                                $fecha_cierre = $row[3];
                            }
                            if($row[8] == '0000-00-00 00:00:00'){
                                $fecha_aprobada = "";
                            }else{
                                $fecha_aprobada = $row[8];
                            }
                            if($row[9] == '0000-00-00 00:00:00'){
                                $fecha_completa = "";
                            }else{
                                $fecha_completa = $row[9];
                            }
                        ?>
                        <tr>
                            <td class="tabla-mes"><a href="seguimiento.php?requisicion=<?php echo $row[0];?>" target="_blank"><?php echo $row[0]?></a></td>
                            <td class="tabla-mes"><a href="../Requisiciones-PDF/<?php echo $row[0]; ?>.pdf" target="_blank"><img src="pdf.png" width="20px" alt=""></a></td>
                            <td class="tabla-mes"><?php echo $row[1]?></td>
                            <td class="tabla-mes"><?php echo $nombre_usuario?></td>
                            <td class="tabla-mes"><?php echo $fecha_aprobada?></td>
                            <td class="tabla-mes"><?php echo $fecha_completa?></td>
                            <td class="tabla-mes"><?php echo $fecha_cierre; ?></td>
                            <td class="tabla-mes"><?php echo $nombre_usuario2?></td>
                            <td class="tabla-mes"><?php echo $row[5]?></td>
                            <td class="tabla-mes"><?php echo $row[6]?></td>
                            <td class="tabla-mes"><?php echo $nombre_departamento?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                <hr />
                <br>
                <div><?php echo $PAGINADOR->ver_pagina("index.php")?></div>
            </div>
            <div class="border"></div>
            <footer class="footer"></footer>
        </div>
    </section>
</body>
<script src="../asset/js/sidebar.js"></script>
</html>