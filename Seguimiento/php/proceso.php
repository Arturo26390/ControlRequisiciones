<?php
include("../../Includes/connection.php");

$opcion = $_POST['opcion'];

if($opcion == 1){

    $requisicion = $_POST['requisicion'];
    $producto = $_POST['producto'];
    $cantidad_producto = $_POST['cantidad_producto'];
    $cantidad_entregada = $_POST['cantidad_entregada'];

    $cantidad_resultado = $cantidad_producto - $cantidad_entregada;

    $update = "UPDATE CREQ_REQUISICIONES_DETALLE SET CANTIDAD_FATANTE=".$cantidad_resultado." WHERE CLAVE_REQUISICION = '".$requisicion."' AND CLAVE_PRODUCTO = ".$producto;
    $ejecuta_update = mysqli_query($con, $update);

}

?>
