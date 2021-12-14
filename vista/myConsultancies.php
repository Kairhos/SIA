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

        <script type="text/javascript" src="../js/jquery.tablesorter.min.js"></script>
        <script src="../js/utils.js"></script>
        <script src="../js/search.js"></script>
        <script src="../js/myConsultancies.js"></script>
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
            <div id="consultancies-cont">
                <div id="table-cont" class="hide-scroll">
                    <table id="consul-table" class="local-table tablesorter">
                        <thead>
                            <tr class="table-row">
                                <th class="table-cell">
                                    ID
                                </th>
                                <th class="table-cell">
                                    Asesor
                                </th>
                                <th class="table-cell">
                                    Materia
                                </th>
                                <th class="table-cell">
                                    Estado
                                </th>
                                <th class="table-cell" style="cursor: default;">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody id="sch-tbody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal modal-op-0" tabindex="-1" role="dialog" id="modal-modify">
            <div class="msg-alert" id="form-error">
                <span></span>
            </div>
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modificar solicitud</h5>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-auto">
                                    <label for="lugar">Lugar</label>
                                    <input type="text" class="form-control" id="lugar" placeholder="Especifique" required>
                                </div>
                                <div class="col-auto">
                                    <label for="date-picker">Fecha</label>
                                    <input type="date" id="date-picker" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-auto">
                                    <label for="start-time">H. Inicio</label>
                                    <input type="number" class="form-control" id="start-time" min="8" max="19">
                                </div>
                                <div class="col-auto">
                                    <label for="end-time">H. Fin</label>
                                    <input type="number" class="form-control" id="end-time" min="9" max="20">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="save-chng" type="button" class="btn btn-modal">Guardar cambios</button>
                        <button id="close-modal-0" type="button" class="btn btn-modal close-modal" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal modal-op-1" tabindex="-1" role="dialog" id="modal-delete">
            <div class="modal-dialog modal-dialog-centered modal" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Borrar registro?</h5>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>La informaci&oacute;n de esta solicitud será descartada. 
                            Deseas continuar?
                        </p>
                    </div>  
                    <div class="modal-footer">
                        <button id="del-rqst" type="button" class="btn btn-modal">Si, cancelar</button>
                        <button id="close-modal-1" type="button" class="btn btn-modal close-modal" data-dismiss="modal">No, regresar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal modal-op-2" tabindex="-1" role="dialog" id="modal-cancel">
            <div class="modal-dialog modal-dialog-centered modal" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cancelar solicitud?</h5>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Esta solicitud será cancelada y su informaci&oacute;n borrada.
                            <br>Deseas continuar?
                        </p>
                    </div>  
                    <div class="modal-footer">
                        <button id="del-rqst" type="button" class="btn btn-modal">Si, cancelar</button>
                        <button id="close-modal-2" type="button" class="btn btn-modal close-modal" data-dismiss="modal">No, regresar</button>
                    </div>
                </div>
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