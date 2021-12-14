<?php
    require 'conect.php';

    $matId = $mysqli->real_escape_string($_POST['matId']);
    $state = $mysqli->real_escape_string($_POST['state']);
    $matricula = $mysqli->real_escape_string($_POST['matricula']);

    if($nueva_consulta = $mysqli->prepare("
    update asesoria set estado = ? where matricula = ? and id_materia = ?
    ")){
        $nueva_consulta->bind_param('iii', $state, $matricula, $matId);
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