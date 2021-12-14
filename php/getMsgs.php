<?php
    require 'conect.php';

    $matricula = $mysqli->real_escape_string($_POST['matricula']);

    if($nueva_consulta = $mysqli->prepare("
    select mensaje.id_msg as id,
    concat(estudiante.apellido_p, ' ', estudiante.apellido_m, ' ', estudiante.nombre) as nombre,
    mensaje.estado as state, mensaje.msg as msg
    from mensaje inner join estudiante
    on estudiante.matricula = mensaje.mat_origen
    where mensaje.mat_dest = ? and tipo = 1
    ")){
        $nueva_consulta->bind_param('i', $matricula);
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