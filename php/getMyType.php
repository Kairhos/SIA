<?php
    require 'conect.php';

    $matricula = $mysqli->real_escape_string($_POST['matricula']);

    if($nueva_consulta = $mysqli->prepare("
    select tipo_usuario from usuario where matricula = ?
    ")){
        $nueva_consulta->bind_param('i', $matricula);
        $nueva_consulta->execute();
        $resultado = $nueva_consulta->get_result();

        if($resultado->num_rows == 1){
            $r = $resultado->fetch_assoc();
            echo json_encode(array('error' => false, 'tipo'=>$r['tipo_usuario']));
        } else{
            echo json_encode(array('error' => true));
        }
        $nueva_consulta->close();
    }
    $mysqli->close();
?>