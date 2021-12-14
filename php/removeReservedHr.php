<?php
    require 'conect.php';

    $matricula = $mysqli->real_escape_string($_POST['matricula']);
    $dia = $mysqli->real_escape_string($_POST['dia']);
    $hora = $mysqli->real_escape_string($_POST['hora']);

    if($nueva_consulta = $mysqli->prepare("
        delete from hora_reservada
        where matricula = ? and hora = ? and dia = ?
    ")){
        $nueva_consulta->bind_param('iii', $matricula, $hora, $dia);
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