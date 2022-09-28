<?php
    include("Includes/connection.php");
    
    $usuario = $_POST['username'];
    $password = $_POST['password'];
    $_SESSION['usuario']=$_POST['username'];

    if(!empty($_POST['username']) && !empty($_POST['password'])) 
	{
		$usuario = $_POST['username'];
        $password = $_POST['password'];
		$consulta_usuarios = "SELECT * FROM CREQ_USUARIOS WHERE USERNAME = '".$usuario."' AND PASSWORD = '".$password."'";
        $ejecuta_consulta_usuarios = mysqli_query($con, $consulta_usuarios);
		$numrows=mysqli_num_rows($ejecuta_consulta_usuarios);
		if($numrows!=0)
		{
			while($row=mysqli_fetch_assoc($ejecuta_consulta_usuarios))
			{
				$dbusername=$row['CLAVE'];
				$dbpassword=$row['CONTRASENA'];
			}
			if($username == $dbusername && $password == $dbpassword)
			{
				echo "<br>correcto";
				header("Location: inicio.php");
			}
		} 
		else 
		{
			$message =  "Nombre de usuario ó contraseña invalida!";
			unset($_SESSION['usuario']);
		}
	} 
	else 
	{
		$message = "Todos los campos son requeridos!";
	}

?>