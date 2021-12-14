<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header('Location: ../index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>prueba</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
   

    <link rel="stylesheet" href="../css/utils.css">
    <link rel="stylesheet" href="../css/myProfile.css">

    <script type="text/javascript" src="../js/jquery.tablesorter.min.js"></script>
    <script src="../js/search.js"></script>
    <script src="../js/utils.js"></script>
    <script src="../js/profileInfo.js"></script>
    <script src="../js/myProfile.js"></script>
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
        <div class="msg-alert" id="login-error">
            <span></span>
        </div>
        <div id="profile-cont">
            <div id="pic-container">
                <image id="profile-pic"></image>
                <span id="nombre-usr"></span>
            </div>
            <div id="info-cont">
                <span id="matricula"></span>
                <span id="nombre"></span>
                <span id="semestre"></span>
                <span id="edad"></span>
                <span id="sexo"></span>
                <span id="facultad"></span>
                <span id="carrera"></span>
                <span id="plan"></span>
            </div>
            <div id="options-cont">
                <div id="prof-btn-cont-0">
                    <button id="profile-op-0" class="user-options">
                        &nbsp;<i class="far fa-eye-slash"></i>&nbsp;&nbsp;Desactivar asr.
                    </button>
                </div>
                <div id="prof-btn-cont-1">
                    <button id="profile-op-1" class="user-options">
                        &nbsp;<i class="fas fa-calendar-check"></i>&nbsp;&nbsp;Mis solicitudes
                    </button>
                </div>
                <button id="profile-op-2" class="user-options">
                    &nbsp;<i class="fas fa-plus-square"></i>&nbsp;&nbsp;Alta de materia
                </button>
                <button id="profile-op-3" class="user-options">
                    &nbsp;<i class="fas fa-envelope"></i>&nbsp;&nbsp;Mis mensajes
                </button>
                <button id="profile-op-4" class="user-options">
                    &nbsp;<i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;Cerrar sesi&oacute;n
                </button>
            </div>
        </div>
        <div class="modal" tabindex="-1" role="dialog" id="modal-op-0">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Desactivar materias</h5>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="switch-form">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="save-mat-state" type="button" class="btn btn-modal">Guardar cambios</button>
                        <button id="close-modal-0" type="button" class="btn btn-modal close-modal-btn" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" tabindex="-1" role="dialog" id="modal-op-1">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Mis solicitudes</h5>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="consultancies-cont" style="width:100%;">
                            <div id="table-cont" class="hide-scroll">
                                <table id="consul-table" class="local-table tablesorter">
                                    <thead>
                                        <tr class="table-row">
                                            <th class="table-cell">
                                                ID
                                            </th>
                                            <th class="table-cell">
                                                Solicitante
                                            </th>
                                            <th class="table-cell">
                                                Materia
                                            </th>
                                            <th class="table-cell">
                                                Fecha
                                            </th>
                                            <th class="table-cell">
                                                Hora
                                            </th>
                                            <th class="table-cell" style="cursor: default;">
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="consul-tbody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="close-modal-1" type="button" class="btn btn-modal close-modal-btn" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" tabindex="-1" role="dialog" id="modal-op-2">
            <div class="msg-alert" id="login-error">
                <span></span>
            </div>
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Solicitar alta de materia</h5>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="alta-cont">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="solic-confirm" type="button" class="btn btn-modal">Solicitar</button>
                        <button id="close-modal-2" type="button" class="btn btn-modal close-modal-btn" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" tabindex="-1" role="dialog" id="modal-op-3">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Mis mensajes</h5>
                        </button>
                    </div>
                    <div class="modal-body">
                    <div id="msg-cont" style="width:100%;">
                            <div id="table-cont" class="hide-scroll">
                                <table id="msg-table" class="local-table tablesorter">
                                    <thead>
                                        <tr class="table-row">
                                            <th class="table-cell">
                                                ID
                                            </th>
                                            <th class="table-cell">
                                                Remitente
                                            </th>
                                            <th class="table-cell">
                                                Estado
                                            </th>
                                            <th class="table-cell">
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="msg-tbody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="close-modal-3" type="button" class="btn btn-modal close-modal-btn" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" tabindex="-1" role="dialog" id="modal-op-4">
            <div class="modal-dialog modal-dialog-centered modal" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cerrar sesi&oacute;n?</h5>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>La informaci&oacute;n no guardada o enviada ser&aacute; descartada.
                            <br>Deseas continuar?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button id="logout-confirm" type="button" class="btn btn-modal">Cerrar sesi&oacute;n</button>
                        <button id="close-modal-4" type="button" class="btn btn-modal close-modal-btn" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <!-- <div id="footer-container">
            <button id="logout-btn" type="button" class="btn btn-outline-danger">
                <i class="fas fa-sign-out-alt"></i>
            </button>
            <button id="notif-btn" type="button" class="btn btn-outline-primary">
                <i class="fas fa-bell"></i>
            </button>
        </div> -->
    </footer>
</body>

</html>