<?php
    require 'conect.php';

    $id = $mysqli->real_escape_string($_POST['id']);

    if($nueva_consulta = $mysqli->prepare("
    update solicitud
    set fecha = ?, lugar = ?, hora_inicio = ?, hora_fin = ?
    where id_solic = ?
    ")){
        $nueva_consulta->bind_param('ssssi', $_POST['fecha'], $_POST['lugar'], $_POST['inicio'], $_POST['fin'], $id);
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