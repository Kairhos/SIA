<?php
    $mysqli = new mysqli('localhost', 'root', '', 'bdweb');
    if($mysqli->connect_errno):
        echo "Error al conectar con BD: ".$mysqli->connect_error;
    endif;
?>