<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="asset/imgs/favicon.png" type="image/png" />
    <link rel="stylesheet" href="asset/css/style.css">
    <!-- script -->
    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
    <script src="asset/js/password.js"></script>
</head>
<?php
include("Includes/connection.php");
if(isset($_SESSION['usuario']))
{
	header("Location: inicio.php");
	return;
}
if(isset($_POST["login"])){
    $_SESSION['usuario']=$_POST['username'];
	$_SESSION['inicio']=time();
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
                $dbusername=$row['USERNAME'];
                $dbpassword=$row['PASSWORD'];
            }
            if($usuario == $dbusername && $password == $dbpassword)
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
}
?>
<body class="body-bg">
    <div class="body-d">
        <img src="asset/imgs/logo_mes_actual.jpg" class="form-logo">
        <div class="border"></div>
        <form action="" method="post" class="form-container" id="login" class="form form-login--resize">
            <div class="cont-login">
                <br>
                <div class="form-group">
                    <h4 class="form-titulo__tabla">Iniciar Sesión </h4>
                </div>
                <br> <br>
                <div class="form-contenedor-datos">
                    <input class="form-contenedor-datos__input" name="username" type="text" placeholder="Usuario" />
                    <lord-icon 
                        src="https://cdn.lordicon.com/dxjqoygy.json" 
                        trigger="loop"
                        style="width:50px; height:50px">
                    </lord-icon>
                </div>
                <br>
                <div class="form-contenedor-datos">
                    <input class="form-contenedor-datos__input form__password-eye" name="password" type="password" placeholder="Contraseña" />
                    <lord-icon 
                        src="https://cdn.lordicon.com/tyounuzx.json" 
                        trigger="click"
                        style="width:50px;height:50px" 
                        class="icon-eye" 
                        onclick="revelaPassword()">
                    </lord-icon>
                </div>
                <br>
                <br>
                <div style="width: 100%;">
                    <button class="form__submit form__submit--redesign" type="submit" name="login">Entrar</button>
                </div>
                </br>
                </br>
                <div>
                    <?php
                    if (!empty($message)) 
                    {
                        echo "<p class=\"error\">" . "". $message . "</p>";
                    } 
                    ?>
                </div>
                <!-- <a class="contenedor-manual" href='#'>
                    <lord-icon 
                        src="https://cdn.lordicon.com/wxnxiano.json" 
                        trigger="morph"
                        style="width:50px;height:50px" 
                        onclick="abrirmanual()">
                    </lord-icon>
                    <span> Manual de usuario </span>
                </a> -->
                <br>
            </div>
        </form>
        <div class="border"></div>
    </div>
</body>

</html>