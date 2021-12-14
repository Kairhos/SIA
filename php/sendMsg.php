<?php
    require 'conect.php';

    $tipo = $_POST['tipo'];
    $estado = $_POST['estado'];

    if($nueva_consulta = $mysqli->prepare("
        insert into mensaje(mat_origen, mat_dest, msg, estado, tipo)
        values (?, ?, ?, ?, ?);
    ")){
        $nueva_consulta->bind_param('iisii', $_POST['origen'], $_POST['destino'],$_POST['msg'],$_POST['estado'],$_POST['tipo']);
        $nueva_consulta->execute();
        $resultado = $nueva_consulta->get_result();

        if(!$resultado){
            echo json_encode(array('error' => false, 'tipo'=>$tipo));
        } else{
            echo json_encode(array('error' => true));
        }
        $nueva_consulta->close();
    }

    $mysqli->close();
?>