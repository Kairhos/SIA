<?php
    require 'conect.php';

    $asdo = $mysqli->real_escape_string($_POST['asdo']);
    $asr = $mysqli->real_escape_string($_POST['asr']);

    if($nueva_consulta = $mysqli->prepare("
        select id_solic from solicitud where mat_asdo = ? and mat_asr = ? and estado = 3
    ")){
        $nueva_consulta->bind_param('ii', $asdo, $asr);
        $nueva_consulta->execute();
        $resultado = $nueva_consulta->get_result();

        if($resultado->num_rows > 0){
            echo json_encode(array('error' => false));
        } else{
            echo json_encode(array('error' => true));
        }
        $nueva_consulta->close();
    }

    $mysqli->close();
?>