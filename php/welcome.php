<?php
    require 'conect.php';

    $matricula = $mysqli->real_escape_string($_POST['matricula']);

    if($nueva_consulta = $mysqli->prepare("select ruta from user_profile where matricula = ?")){
        $nueva_consulta->bind_param('i', $matricula);
        $nueva_consulta->execute();
        $resultado = $nueva_consulta->get_result();

        if($resultado->num_rows == 1){
            $datos = $resultado->fetch_assoc();
            echo json_encode(array('error' => false, 'ruta'=>$datos['ruta']));
        } else{
            echo json_encode(array('error' => true));
        }
        $nueva_consulta->close();
    }

    $mysqli->close();
?>