<?php
    require 'conect.php';

    $matricula = $mysqli->real_escape_string($_POST['matricula']);

    if($nueva_consulta = $mysqli->prepare("
    select solicitud.id_solic as id, solicitud.fecha as fecha, concat(solicitud.hora_inicio, '.', solicitud.hora_fin) as hora,
    concat(estudiante.apellido_p, ' ', estudiante.apellido_m, ' ', estudiante.nombre) as asdo,
    materia.nombre_materia as mat
    from ((solicitud inner join materia on solicitud.id_materia = materia.id_materia)
    inner join estudiante on solicitud.mat_asdo = estudiante.matricula)
    where solicitud.mat_asr = ? and solicitud.estado = 0
    ")){
        $nueva_consulta->bind_param('i', $matricula);
        $nueva_consulta->execute();
        $resultado = $nueva_consulta->get_result();

        if($resultado->num_rows >0){
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
