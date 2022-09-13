<?php
include("../Includes/connection.php");

$FechaHora = mysqli_query($con, "SELECT CURDATE() AS FECHA, CURTIME() AS HORA");
$datosFechaHora = mysqli_fetch_array($FechaHora);
$fecha = $datosFechaHora["FECHA"];
$hora = $datosFechaHora["HORA"];
$usuario = 'mreyes';

$opcion = $_POST["opcion"];

if($opcion == 1){
   $id_producto = $_POST["id_producto"];
   $cantidad = $_POST["cantidad"];
   

   $consulta = "SELECT * FROM CREQ_PRODUCTOS WHERE ID = '".$id_producto."'";
	$resultado = mysqli_query($con, $consulta);


	if(mysqli_num_rows($resultado) > 0){
      $fila = mysqli_fetch_array($resultado);
      $precio_unitario = $fila["PRECIO"];
      $costo_total = $precio_unitario * $cantidad;
      echo $precio_unitario."|".$costo_total;
   }else{
      echo "0.00|0.00";
   }
   
}

if($opcion == 2){
   
   $vector_fecha=explode("-",$fecha);


   $area = $_POST["area"];
   $patente = $_POST["patente"];
   $prioridad = $_POST["prioridad"];
   $comentarios = $_POST["comentarios"];
   $num_productos = $_POST["num_productos"];

   $vector_productos = explode("|",$_POST["vector_productos"]);

   $vector_cantidad = explode("|",$_POST["vector_cantidad"]);
   $vector_observaciones = explode("|",$_POST["vector_observaciones"]);
   $vector_precio_unitario = explode("|",$_POST["vector_precio_unitario"]);
   $vector_total = explode("|",str_replace("$","",$_POST["vector_total"]));

   $consulta_area= "SELECT * FROM `CREQ_DEPARTAMENTOS` WHERE ID = '".$area."';";
   $ejecuta_consulta_area = mysqli_query($con, $consulta_area);
   $datosArea = mysqli_fetch_array($ejecuta_consulta_area);
   $clave_area = $datosArea["CLAVE"];
   

   $consulta_requi = "SELECT * FROM `CREQ_REQUISICIONES_GENERAL` WHERE SUBSTR(FECHA_CAPTURA,1,10) = '".$fecha."' AND DEPARTAMENTO = '".$area."';";
   //echo $consulta_requi;
   $ejecuta_consulta_requi = mysqli_query($con, $consulta_requi);

   if(mysqli_num_rows($ejecuta_consulta_requi)>0){
      $numero = mysqli_num_rows($ejecuta_consulta_requi) + 1;
      $clave_requisicion = $vector_fecha[0].$vector_fecha[1].$vector_fecha[2].$clave_area."-".$numero;
   }else{
      $clave_requisicion = $vector_fecha[0].$vector_fecha[1].$vector_fecha[2].$clave_area."-1";
   }
   $total_producto = 0;
   for($i=0; $i<$num_productos; $i++){
      $clave_producto = $vector_productos[$i];
      $cantidad_prodcuto = $vector_cantidad[$i];
      $observaciones_producto = $vector_observaciones[$i];
      $precio_unitario_producto = $vector_precio_unitario[$i];
      $total_producto = $total_producto + $vector_total[$i];

      $insert_detalle = "INSERT INTO CREQ_REQUISICIONES_DETALLE (CLAVE_REQUISICION, CLAVE_PRODUCTO, CANTIDAD_PRODUCTO, OBSERVACIONES) VALUES ('".$clave_requisicion."','".$clave_producto."','".$cantidad_prodcuto."','".$observaciones_producto."')";
      //echo $insert_detalle."<br>";
      mysqli_query($con, $insert_detalle);

   }
   
   $insert_general = "INSERT INTO CREQ_REQUISICIONES_GENERAL (CLAVE_REQUISICION, FECHA_CAPTURA, FECHA_CIERRE, USUARIO_CAPTURA, USUARIO_CIERRE, PRIORIDAD, PATENTE, DEPARTAMENTO, COSTO_TOTAL, COMENTARIOS_ADICIONALES) VALUES ('".$clave_requisicion."','".$fecha." ".$hora."','','".$usuario."','','".$prioridad."','".$patente."','".$area."','".$total_producto."','".$comentarios."')";
   //echo $insert_general;
   mysqli_query($con, $insert_general);

   echo $clave_requisicion;
}

if($opcion == 3){
   $vector_fecha=explode("-",$fecha);
   $area = $_POST["area"];
   $producto = $_POST["producto"];
   $precio = str_replace("$","",$_POST["precio"]);

   
   $consulta_productos = "SELECT * FROM CREQ_PRODUCTOS";
   $ejecuta_consulta_productos = mysqli_query($con, $consulta_productos);
   $id_siguiente = mysqli_num_rows($ejecuta_consulta_productos) + 1;

   $auto_increment = "ALTER TABLE CREQ_PRODUCTOS AUTO_INCREMENT = ".$id_siguiente;
   $ejecuta_auto_increment = mysqli_query($con, $auto_increment);

   $insert_producto = "INSERT INTO CREQ_PRODUCTOS (NOMBRE, DEPARTAMENTO, PRECIO) VALUES ('".$producto."','".$area."','".$precio."')";
   $ejecuta_insert_producto = mysqli_query($con, $insert_producto);
   //echo "aqui   ".$insert_producto."<br>";


   $consulta_area= "SELECT * FROM `CREQ_DEPARTAMENTOS` WHERE ID = '".$area."';";
   $ejecuta_consulta_area = mysqli_query($con, $consulta_area);
   $datosArea = mysqli_fetch_array($ejecuta_consulta_area);
   $clave_area = $datosArea["CLAVE"];

   $consulta_requi = "SELECT * FROM `CREQ_REQUISICIONES_GENERAL` WHERE SUBSTR(FECHA_CAPTURA,1,10) = '".$fecha."' AND DEPARTAMENTO = '".$area."';";
   //echo $consulta_requi;
   $ejecuta_consulta_requi = mysqli_query($con, $consulta_requi);

   if(mysqli_num_rows($ejecuta_consulta_requi)>0){
      $numero = mysqli_num_rows($ejecuta_consulta_requi) + 1;
      $clave_requisicion = $vector_fecha[0].$vector_fecha[1].$vector_fecha[2].$clave_area."-".$numero;
   }else{
      $clave_requisicion = $vector_fecha[0].$vector_fecha[1].$vector_fecha[2].$clave_area."-1";
   }

   echo $clave_requisicion;

}

if($opcion == 4){

   $consulta = "SELECT * FROM CREQ_PRODUCTOS";
	$resultado = mysqli_query($con, $consulta);
   //if(mysqli_num_rows($resultado)==0){
      $numero = $_POST["numero"];
      $id_nuevo = mysqli_num_rows($resultado)+$numero;
   //}else{
     // $id_nuevo = mysqli_num_rows($resultado)+1;
   //}
   
   //echo mysqli_num_rows($resultado)."+".$numero;
   echo $id_nuevo;

}

?>
