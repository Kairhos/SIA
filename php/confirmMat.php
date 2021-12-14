<?php
    require 'conect.php';

    $id = $mysqli->real_escape_string($_POST['idMat']);

    if($nueva_consulta = $mysqli->prepare("
    select nombre_materia from materia where id_materia = ?
    ")){
        $nueva_consulta->bind_param('i', $id);
        $nueva_consulta->execute();
        $resultado = $nueva_consulta->get_result();

        if($resultado->num_rows == 1){
            echo json_encode(array('error' => false));
        } else{
            echo json_encode(array('error' => true));
        }
        $nueva_consulta->close();
    }
    $mysqli->close();
?>