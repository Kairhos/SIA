<?php
    require 'conect.php';

    $id = $mysqli->real_escape_string($_POST['idMsg']);

    if($nueva_consulta = $mysqli->prepare("
    select estado from mensaje where id_msg = ?
    ")){
        $nueva_consulta->bind_param('i', $id);
        $nueva_consulta->execute();
        $resultado = $nueva_consulta->get_result();

        if($resultado->num_rows == 1){
            $nueva_consulta = $mysqli->prepare("
                update mensaje set estado = 1 where id_msg = ?
            ");
            $nueva_consulta->bind_param('i', $id);
            $nueva_consulta->execute();
            $resultado = $nueva_consulta->get_result();

            if(!$resultado){
                echo json_encode(array('error' => false));
            }else{
                echo json_encode(array('error' => true));
            }
        } else{
            echo json_encode(array('error' => true));
        }
        $nueva_consulta->close();
    }
    $mysqli->close();
?>