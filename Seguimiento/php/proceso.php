<?php
include("../../Includes/connection.php");
$FechaHora = mysqli_query($con, "SELECT CURDATE() AS FECHA, CURTIME() AS HORA");
$datosFechaHora = mysqli_fetch_array($FechaHora);
$fecha = $datosFechaHora["FECHA"];
$hora = $datosFechaHora["HORA"];
$usuario = 'mreyes';
$opcion = $_POST['opcion'];

if($opcion == 1){

    $requisicion = $_POST['requisicion'];
    $producto = $_POST['producto'];
    $cantidad_producto = $_POST['cantidad_producto'];
    $cantidad_entregada = $_POST['cantidad_entregada'];

    $cantidad_resultado = $cantidad_producto - $cantidad_entregada;

    if($cantidad_resultado == 0){
        $update_general = "UPDATE CREQ_REQUISICIONES_GENERAL SET FECHA_CIERRE = '".$fecha." ".$hora."', USUARIO_CIERRE = '".$usuario."' WHERE CLAVE_REQUISICION = '".$requisicion."'";
        $ejecuta_update_general = mysqli_query($con, $update_general);
    }
    $update = "UPDATE CREQ_REQUISICIONES_DETALLE SET CANTIDAD_FALTANTE=".$cantidad_resultado." WHERE CLAVE_REQUISICION = '".$requisicion."' AND CLAVE_PRODUCTO = ".$producto;
    $ejecuta_update = mysqli_query($con, $update);

    $insert_bitacora = "INSERT INTO CREQ_BITACORA_ENTREGAS (CLAVE_REQUISICION,CLAVE_PRODUCTO,CANTIDAD_ENTREGADA,FECHA_ENTREGA) VALUES ('".$requisicion."','".$producto."',".$cantidad_entregada.",'".$fecha." ".$hora."')";
    $ejecuta_insert_bitacora = mysqli_query($con, $insert_bitacora);


    /////////////////////////////////////// ENVIO DE CORREO A IDT ENTREGA DE PRODUCTOS //////////////////////////////////////////////////////////////////////////







    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}

if($opcion == 2){
    echo '1';
}

?>
