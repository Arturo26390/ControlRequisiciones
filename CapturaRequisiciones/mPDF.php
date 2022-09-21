<?php
require  '../Includes/vendor/autoload.php';
// require  '../GENERA_FACTURAS/vendor/autoload.php';

include("../Includes/connection.php");

$clave_requisicion = $_POST['clave_requisicion'];
//$clave_requisicion = '20220825IDT-1';

$consulta_general = "SELECT * FROM CREQ_REQUISICIONES_GENERAL WHERE CLAVE_REQUISICION = '".$clave_requisicion."'";
//echo $consulta_general;
$ejecuta_consulta_general = mysqli_query($con, $consulta_general);
$fila_general = mysqli_fetch_array($ejecuta_consulta_general);

$fecha_captura = $fila_general['FECHA_CAPTURA'];
$usuario_captura = $fila_general['USUARIO_CAPTURA'];
$prioridad = $fila_general['PRIORIDAD'];
$patente = $fila_general['PATENTE'];
$departamento = $fila_general['DEPARTAMENTO'];
$costo_total_requi = $fila_general['COSTO_TOTAL'];
$comentarios = $fila_general['COMENTARIOS_ADICIONALES'];

$consulta_area = "SELECT * FROM CREQ_DEPARTAMENTOS WHERE ID='".$departamento."'";
$ejecuta_consulta_area = mysqli_query($con, $consulta_area);
$fila_area = mysqli_fetch_array($ejecuta_consulta_area);
$clave_area = $fila_area['CLAVE'];




$html = '
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Plantilla</title>
</head>
<body>
<div id="principal">
   <table class="tabla_1">
        <tr>
            <td width="20%"><img src="../img/cae-meta.png" width="200px"></td>
            <td width="80%" align="center" colspan="2" id="titulo">Requisición de Compra</td>
        </tr>
        <tr>
            <td width="33%" align="center">Fecha de emisión: 28.08.2019</td>
            <td width="33%" align="center">Edición: 1/28.08.2019</td>
            <td width="33%" align="center">F-CAE-FNZ002</td>
        </tr>
   </table>
   <table class="tabla_2">
        <tr>
            <td width="20%" align="center"></td>
            <td width="20%" align="center"></td>
            <td width="20%" align="center"></td>
            <td width="20%" align="center"></td>
            <td width="20%" align="center"></td>
        </tr>  
        <tr>
            <td width="25%" align="right"></td>
            <td width="20%" align="center"></td>
            <td width="25%" align="right">FOLIO:</td>
            <td width="20%" align="center" class="id1">'.$clave_requisicion.'</td>
            <td width="10%" align="right"></td>
        </tr>
   </table>
   <br>
   <table class="tabla_2">
        <tr>
            <td width="25%" align="right">AREA O DEPARTAMENTO:</td>
            <td width="20%" align="center" class="id1">'.$clave_area.'</td>
            <td width="25%" align="right">FECHA DE SOLICITUD:</td>
            <td width="20%" align="center" class="id1">'.$fecha_captura.'</td>
            <td width="10%" align="right"></td>
        </tr>
        <tr>
            <td width="20%" align="center"></td>
            <td width="20%" align="center"></td>
            <td width="20%" align="center"></td>
            <td width="20%" align="center"></td>
            <td width="20%" align="center"></td>
        </tr>  
        <tr>
            <td width="25%" align="right">PATENTE:</td>
            <td width="20%" align="center" class="id1">'.$patente.'</td>
            <td width="25%" align="right">PRIORIDAD:</td>
            <td width="20%" align="center" class="id1">'.$prioridad.'</td>
            <td width="10%" align="right"></td>
        </tr>
        <tr>
            <td width="20%" align="center"></td>
            <td width="20%" align="center"></td>
            <td width="20%" align="center"></td>
            <td width="20%" align="center"></td>
            <td width="20%" align="center"></td>
        </tr>  
   </table>
   <br><br>
   <table class="tabla_3" align="center">
        <tr>
            <td width="44%" align="center">Nombre</td>
            <td width="6%" align="center">Cantidad</td>
            <td width="10%" align="center">Costo Unitario</td>
            <td width="10%" align="center">Costo total</td>
            <td width="30%" align="center">Observaciones</td>
        </tr>';


            $consulta_detalle = "SELECT * FROM CREQ_REQUISICIONES_DETALLE WHERE CLAVE_REQUISICION = '".$clave_requisicion."'";
            $ejecuta_consulta_detalle = mysqli_query($con, $consulta_detalle);
            $numero_productos = mysqli_num_rows($ejecuta_consulta_detalle);
            $cantidad_total_productos = 0;
            while($fila_detalle = mysqli_fetch_array($ejecuta_consulta_detalle)){
                $cantidad_producto = $fila_detalle['CANTIDAD_PRODUCTO'];
                $id_producto = $fila_detalle['CLAVE_PRODUCTO'];
                $observaciones_producto = $fila_detalle['OBSERVACIONES'];

                $consulta_producto = "SELECT * FROM CREQ_PRODUCTOS WHERE ID='".$id_producto."'";
                //echo $consulta_producto;
                $ejecuta_consulta_producto = mysqli_query($con, $consulta_producto);
                $fila_producto = mysqli_fetch_array($ejecuta_consulta_producto);
                $nombre_producto = $fila_producto['NOMBRE'];
                $costo_unitario_producto = $fila_producto['PRECIO'];
                
                $costo_total_producto = $cantidad_producto * $costo_unitario_producto;
                $cantidad_total_productos = $cantidad_total_productos + $cantidad_producto;
    
                $html .= '<tr>
                    <th width="44%" align="center">'.$nombre_producto.'</th>
                    <th width="6%" align="center"> '.$cantidad_producto.'</th>
                    <th width="10%" align="center">'."$ ".$costo_unitario_producto.'</th>
                    <th width="10%" align="center">'."$ ".$costo_total_producto.'</th>
                    <th width="30%" align="center">'.$observaciones_producto.'</th>
                </tr>';
            }

        $numero_filas = 30-$numero_productos;
        for($i=0; $i<$numero_filas; $i++){
            $html .= '
            <tr>
                <th width="44%" align="center" class="th2"></th>
                <th width="6%"  align="center" class="th2"></th>
                <th width="10%" align="center" class="th2"></th>
                <th width="10%" align="center" class="th2"></th>
                <th width="30%" align="center" class="th2"></th>
            </tr>';
        }
        $html .= '<tr>
            <th width="44%" align="center" class="th1">Total</th>
            <th width="6%" align="center" class="th1">'.$cantidad_total_productos.'</th>
            <th width="10%" align="center" class="th1"></th>
            <th width="10%" align="center" class="th1">'."$ ".$costo_total_requi.'</th>
            <th width="30%" align="center" class="th1"></th>
        </tr>
   </table>
   <br><br>
   <table class="tabla_3" align="center">
        <tr>
            <td colspan="5" align="center">COMENTARIOS ADICIONALES (Detallar y/o justificar la necesidad de la compra)</td>
        </tr>
        <tr>
            <th colspan="5" align="center" id="tr1">'.$comentarios.'</th>
        </tr>
   </table>
   <br><br>
   <table class="tabla_2">
        <tr>
            <td width="5%" align="center"></td>
            <td width="35%" align="center" class="id1">Eduardo Barajas Ibañez</td>
            <td width="10%" align="center"></td>
            <td width="35%" align="center" class="id1">Victor de la Vega/Alejandro Bortolotti</td>
            <td width="5%" align="center"></td>
        </tr>
        <tr>
            <td width="5%" align="center"></td>
            <td width="35%" align="center">Nombre y firma del solicitante</td>
            <td width="10%" align="center"></td>
            <td width="35%" align="center">Nombre y firma del soico director</td>
            <td width="5%" align="center"></td>
        </tr>
   </table>
</div>
</body>';


$mpdf = new \Mpdf\Mpdf();

$mpdf->WriteHTML($html);

$archivo = $clave_requisicion.".pdf";

$mpdf->Output("../Requisiciones-PDF/".$archivo);

echo "<a href='../Requisiciones-PDF/".$archivo."' target='_blank'>Descargar</a>";


?>