<?php
    session_start();
    if(isset($_SESSION['usuario'])){
        header('Location: vista/welcome.php');
    }
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S.I.A. - Login</title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
     
    <link rel="stylesheet" href="css/utils.css">
    <link rel="stylesheet" href="css/login.css">

    <script src="js/utils.js"></script>
    <script src="js/login.js"></script>
</head>

<body>
    <header>
        <div id="logo-container" value="">
            <p id="logo-txt">
                <img src="img/logo.png" alt="" id="logo"> S.I.A
            </p>
        </div>

    </header>
    <div id="main-container" style="height: calc(100vh - 90px);">
        <div class="msg-alert" id="login-error">
            <span></span>
        </div>
        <div class="wrap">
            <form class="login-form" action="" id="login-form">
                <div class="form-header">
                    <h3>Iniciar Sesi&oacute;n</h3>
                    <p>Sistema Institucional de Asesor&iacute;as</p>
                </div>
                <div class="form-group">
                    <input type="text" name="usuario" class="form-input" placeholder="matr&iacute;cula o usuario" required pattern="[A-Za-z0-9.]{5,50}">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-input" placeholder="contrase&ntilde;a" required pattern="[A-Za-z0-9_-]{3,12}">
                </div>
                <div class="form-group">
                    <button class="form-button" id="login-btn" type="submit">Entrar</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>