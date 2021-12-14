<?php
    require 'conect.php';

    $id = $mysqli->real_escape_string($_POST['id']);

    if($nueva_consulta = $mysqli->prepare("
    delete from solicitud where id_solic = ?
    ")){
        $nueva_consulta->bind_param('i', $id);
        $nueva_consulta->execute();
        $resultado = $nueva_consulta->get_result();

        if(!$resultado){
            echo json_encode(array('error' => false));
        } else{
            echo json_encode(array('error' => true));
        }
        $nueva_consulta->close();
    }
    $mysqli->close();
?>