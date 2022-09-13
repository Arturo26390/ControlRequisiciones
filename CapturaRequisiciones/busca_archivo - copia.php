<?php
	include("../Includes/connection.php");
	$ped = $_GET['term'];
	$consulta = "SELECT * FROM CREQ_PRODUCTOS WHERE NOMBRE LIKE '%".$ped."%' GROUP BY NOMBRE LIMIT 10";
	$resultado = mysqli_query($con, $consulta);

	if(mysqli_num_rows($resultado) > 0){
		while($fila = mysqli_fetch_array($resultado)){
			$transportes[] = "label: ".$fila['NOMBRE'].", value:".$fila['ID'];
		}
		echo json_encode($transportes);
	}
?>