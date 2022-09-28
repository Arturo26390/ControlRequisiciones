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
                    <button class="form__submit form__submit--redesign" type="submit">Entrar</button>
                </div>
                </br>
                </br>
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