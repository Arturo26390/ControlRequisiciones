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

    $select = $_POST['select'];
    $clave_requisicion = $_POST['clave_requisicion'];

    if($select == 'SI'){
        $estatus = 'APROBADA';
        ///////////////////////////////////////////////// ENVIO DE CORREO A COMPRAS ////////////////////////////////////////////////////////////////

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
        $mail->Subject    = "Requisicion de Compra Aprobada";
        $texto = "Corporativo Aduanal Especializado Informa:
                            <br><br>
                            Se ha realizado el envio de la siguiente requisicion de compra: ".$clave_requisicion;
        
        
        $mail->MsgHTML($texto);
        $file = "../../Requisiciones-PDF/".$clave_requisicion.".pdf";
        $mail->AddAttachment($file);

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
    }else{
        $estatus = 'ENVIADA';
    }  

    $update = "UPDATE CREQ_REQUISICIONES_GENERAL SET ESTATUS = '".$estatus."' WHERE CLAVE_REQUISICION = '".$clave_requisicion."'";
    $ejecuta_update = mysqli_query($con, $update);

    if($ejecuta_update){
        echo "Correcto!";
    }else{
        echo "Error: Intente de nuevo";
    }
}
?>
