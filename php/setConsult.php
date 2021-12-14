<?php
    require 'conect.php';

    // $solic = $mysqli->real_escape_string($_POST['solInfo']);

    if($nueva_consulta = $mysqli->prepare("
        insert into solicitud(mat_asdo, mat_asr, id_materia,
        estado, fecha, hora_inicio, hora_fin, duracion, lugar, msg)
        values(
            ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
        )
    ")){
        $nueva_consulta->bind_param('iiiissssss', $_POST['matAsdo'], $_POST['matAsr'],$_POST['materia'],$_POST['estado'],$_POST['fecha'],$_POST['tInicio'],$_POST['tFin'],$_POST['duracion'],$_POST['lugar'],$_POST['msg']);
        $nueva_consulta->execute();
        $resultado = $nueva_consulta->get_result();

        if($resultado){
            echo json_encode(array('error' => false));
        } else{
            echo json_encode(array('error' => true));
        }
        $nueva_consulta->close();
    }

    $mysqli->close();
?>