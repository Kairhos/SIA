<?php
    require 'conect.php';

    $regId = $mysqli->real_escape_string($_POST['regId']);

    if($nueva_consulta = $mysqli->prepare("
    select lugar, fecha, hora_inicio, hora_fin from solicitud where id_solic = ?
    ")){
        $nueva_consulta->bind_param('i', $regId);
        $nueva_consulta->execute();
        $resultado = $nueva_consulta->get_result();

        if($resultado->num_rows == 1){
            $rows = $resultado->fetch_assoc();
            echo json_encode(array('error' => false, 'lugar'=>$rows['lugar'], 'fecha'=>$rows['fecha'], 'hora_inicio'=>$rows['hora_inicio'], 'hora_fin'=>$rows['hora_fin']));
        } else{
            echo json_encode(array('error' => true));
        }
        $nueva_consulta->close();
    }

    $mysqli->close();
?>