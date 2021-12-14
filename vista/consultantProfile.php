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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="../css/utils.css">
    <link rel="stylesheet" href="../css/myProfile.css">

    <script src="../js/search.js"></script>
    <script src="../js/utils.js"></script>
    <script src="../js/profileInfo.js"></script>
    <script src="../js/consultantProfile.js"></script>
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
        <div class="msg-alert" id="form-error">
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
                <button id="profile-op-0" class="user-options">
                &nbsp;<i class="fas fa-calendar"></i>&nbsp;&nbsp;Horario
                </button>
                <button id="profile-op-1" class="user-options">
                &nbsp;<i class="fas fa-calendar-plus"></i>&nbsp;&nbsp;Solicitar asesor&iacute;a
                </button>
                <button id="profile-op-2" class="user-options">
                &nbsp;<i class="fas fa-comment-dots"></i>&nbsp;&nbsp;Comentar
                </button>
                <button id="profile-op-3" class="user-options">
                &nbsp;<i class="fas fa-comment-alt"></i>&nbsp;&nbsp;Enviar mensaje
                </button>
                
            </div>
        </div>

        <div id="comments" class="comment-box">
            <h3>&Uacute;ltimos comentarios</h3>
            <div class="comments-cont hide-scroll">
            </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="modal-op-0">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="table-cont" class="hide-scroll"></div>
                    </div>
                    <div class="modal-footer">
                        <button id="close-modal-0" type="button" class="btn btn-modal close-modal" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="modal-op-1">
            <div class="msg-alert" id="form-error">
                <span></span>
            </div>
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Solicitar asesor&iacute;a</h5>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col">
                                    <label for="mat-select">Materia</label>
                                    <select name="Materia" id="mat-select" class="form-control" required>
                                        <option hidden disabled selected>Seleccionar</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="date-picker">Fecha</label>
                                    <input type="date" id="date-picker" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="start-time">H. Inicio</label>
                                    <input type="number" class="form-control" id="start-time" min="8" max="19">
                                </div>
                                <div class="col">
                                    <label for="end-time">H. Fin</label>
                                    <input type="number" class="form-control" id="end-time" min="9" max="20">
                                </div>
                                <div class="col">
                                    <label for="lugar">Lugar</label>
                                    <input type="text" class="form-control" id="lugar" placeholder="Especifique" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="solc-msg">Notas adicionales</label>
                                    <textarea class="form-control" id="solc-msg" maxlength="150"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="request-send" type="button" class="btn btn-modal">Enviar</button>
                        <button id="close-modal-1" type="button" class="btn btn-modal close-modal" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="modal-op-2">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Comentarios para este asesor</h5>
                        </button>
                    </div>
                    <div class="modal-body">
                        <textarea class="text-box" id="text-comment" maxlength="150"></textarea>
                    </div>  
                    <div class="modal-footer">
                        <button id="comment-send" type="button" class="btn btn-modal">Enviar</button>
                        <button id="close-modal-2" type="button" class="btn btn-modal close-modal" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="modal-op-3">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Mensaje para este asesor</h5>
                        </button>
                    </div>
                    <div class="modal-body">
                        <textarea class="text-box" id="text-msg" maxlength="300"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button id="msg-send" type="button" class="btn btn-modal">Enviar</button>
                        <button id="close-modal-3" type="button" class="btn btn-modal close-modal" data-dismiss="modal">Cancelar</button>
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