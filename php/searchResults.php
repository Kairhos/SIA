<?php
    require 'conect.php';

    $materia = $mysqli->real_escape_string($_POST['idMat']);

    if($nueva_consulta = $mysqli->prepare("
    select asesoria.matricula, asesoria.nombre, user_profile.ruta
    from asesoria inner join user_profile
    on asesoria.matricula = user_profile.matricula
    where asesoria.id_materia = ? and asesoria.estado = 1
    ")){
        $nueva_consulta->bind_param('i', $materia);
        $nueva_consulta->execute();
        $resultado = $nueva_consulta->get_result();

        if($resultado->num_rows > 0){
            $rows = array();

            while($r = $resultado->fetch_assoc()){
                $rows[] = array('data' => $r);
            }
            echo json_encode(array('error' => false, 'datos'=>$rows));
        } else{
            echo json_encode(array('error' => true));
        }
        $nueva_consulta->close();
    }

    $mysqli->close();
?>