<?php
    require 'conect.php';

    $matricula = $mysqli->real_escape_string($_POST['matricula']);

    if($nueva_consulta = $mysqli->prepare("
    select * from hora_materia inner join horario
    on horario.id_horario = hora_materia.id_horario
    where horario.matricula = ?
    ")){
        $nueva_consulta->bind_param('i', $matricula);
        $nueva_consulta->execute();
        $resultado = $nueva_consulta->get_result();

        if($resultado->num_rows > 0){
            $rows = array();

            while($r = $resultado->fetch_assoc()){
                $rows[] = array('data' => $r);
            }

            echo json_encode(array('error' => false, 'row'=>$rows));
        } else{
            echo json_encode(array('error' => true));
        }
        $nueva_consulta->close();
    }

    $mysqli->close();
?>