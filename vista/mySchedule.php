<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header('Location: ../index.php');
    }
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />
    
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>prueba</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"
        />

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
        
        <link rel="stylesheet" href="../css/utils.css">

        <script src="../js/search.js"></script>
        <script src="../js/utils.js"></script>
        <script src="../js/profileInfo.js"></script>
        <script src="../js/mySchedule.js"></script>
    </head>

    <body>
    <header>
            <div id="header-cont">
                <div id="logo-container" value="">
                    <a href="welcome.php" id="logo-btn">
                        <p id="logo-txt">
                            <img src="../img/logo.png" alt="" id="logo"> S.I.A
                        </p>
                    </a>
                </div>

                <div id="nav-cont">
                    <button id="op-0" class="main-option">
                        <i class="fas fa-user"></i>&nbsp;Mi perfil
                    </button>
                    <button id="op-1" class="main-option">
                        <i class="fas fa-calendar-alt"></i>&nbsp;Mi horario
                    </button>
                        <button id="op-2" class="main-option">
                        <i class="fas fa-list"></i>&nbsp;Mis asesor&iacute;as
                    </button>
                </div>

                <div id="search-cont">
                    <div id="i-cont">
                        <i id="search-icon" class="fa fa-search fa-2x"></i>
                    </div>
                    <div id="input-cont">
                        <input id="search-input" type="text" autocomplete="on">
                    </div>
                    <div class="search-suggest-cont hide-scroll" id="search-suggest-cont">
                    </div>
                </div>
            </div>
        </header>
        <div id="main-container">
            <div id="schedule-cont">
                <div id="table-cont" class="hide-scroll"></div>
            </div>
        </div>
        <footer>
            <div id="footer-container">
                <!-- <button id="logout-btn" type="button" class="btn btn-outline-danger">
                <i class="fas fa-sign-out-alt"></i>
            </button>
            <button id="notif-btn" type="button" class="btn btn-outline-primary">
                <i class="fas fa-bell"></i>
            </button> -->
            </div>
        </footer>
    </body>
    </html>