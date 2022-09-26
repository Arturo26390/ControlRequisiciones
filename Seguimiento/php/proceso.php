<?php
include("../../Includes/connection.php");
require("../../Includes/php/PHPMailer_5.2.4/class.phpmailer.php");
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

    $update = "UPDATE CREQ_REQUISICIONES_DETALLE SET CANTIDAD_FALTANTE=".$cantidad_resultado." WHERE CLAVE_REQUISICION = '".$requisicion."' AND CLAVE_PRODUCTO = ".$producto;
    $ejecuta_update = mysqli_query($con, $update);

    $insert_bitacora = "INSERT INTO CREQ_BITACORA_ENTREGAS (CLAVE_REQUISICION,CLAVE_PRODUCTO,CANTIDAD_ENTREGADA,FECHA_ENTREGA) VALUES ('".$requisicion."','".$producto."',".$cantidad_entregada.",'".$fecha." ".$hora."')";
    $ejecuta_insert_bitacora = mysqli_query($con, $insert_bitacora);

    $select_prodcuto = "SELECT * FROM CREQ_PRODUCTOS WHERE ID = ".$producto;
    $ejecuta_producto = mysqli_query($con, $select_prodcuto);
    $datosproducto = mysqli_fetch_array($ejecuta_producto);
    $nombre_producto = $datosproducto["NOMBRE"];


    $consulta_detalle = "SELECT SUM(CANTIDAD_FALTANTE) AS TOTAL FROM `CREQ_REQUISICIONES_DETALLE` WHERE CLAVE_REQUISICION = '".$requisicion."'";
    $ejecuta_detalle = mysqli_query($con, $consulta_detalle);
    $datosdetalle = mysqli_fetch_array($ejecuta_detalle);
    $total = $datosdetalle["TOTAL"];

    if($total == 0){
        $update_general = "UPDATE CREQ_REQUISICIONES_GENERAL SET FECHA_COMPLETA = '".$fecha." ".$hora."', USUARIO_CIERRE = '".$usuario."' WHERE CLAVE_REQUISICION = '".$requisicion."'";
        $ejecuta_update_general = mysqli_query($con, $update_general);
    }
    /////////////////////////////////////// ENVIO DE CORREO A IDT ENTREGA DE PRODUCTOS //////////////////////////////////////////////////////////////////////////

    /// CREACION DEL CORREO
    /*-------------------------------------------------------------------------------------------------------------------------------*/
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    $mail->Username   = 'sistemas.puebla@cae3076.com';
    $mail->Password   = "Bcqae610!";
    /*-------------------------------------------------------------------------------------------------------------------------------*/
    //====== DE QUIEN ES ========
    $mail->From       = "sistemas.puebla@cae3076.com";
    $mail->FromName   = "Sistemas Puebla";
    //====== PARA QUIEN =========
    /*-------------------------------------------------------------------------------------------------------------------------------*/
    $mail->Subject    = "Recepcion de material de Requisicion de Compra";
    $texto = "Corporativo Aduanal Especializado Informa:
                        <br><br>
                        Se ha recibido material de la requisicion: ".$requisicion."<br><br>";

    $texto .= "Se ha recibido en el area de compras lo siguiente:
    <br><br>
    Producto: <strong>".$nombre_producto."</strong><br>
    Cantidad: <strong>".$cantidad_entregada."</strong><br><br>
    Favor de pasar a recoger!
    ";                    
    
    
    $mail->MsgHTML($texto);
    //$file = "../../Requisiciones-PDF/".$requisicion.".pdf";
    //$mail->AddAttachment($file);

    $mail->AddAddress("mnavarrete@cae3076.com");

    $exito = $mail->Send();
    /*-------------------------------------------------------------------------------------------------------------------------------*/
    //Si el mensaje no ha podido ser enviado se realizaran 4 intentos mas como mucho 
    //para intentar enviar el mensaje, cada intento se hara 5 segundos despues 
    //del anterior, para ello se usa la funcion sleep
    /*-------------------------------------------------------------------------------------------------------------------------------*/	
    $intentos=1; 
    while ((!$exito) && ($intentos < 5)) {
    sleep(2);
        //echo $mail->ErrorInfo;
        $exito = $mail->Send();
        $intentos=$intentos+1;	
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}

if($opcion == 2){
    
}

?>
