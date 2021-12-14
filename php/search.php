<?php
    require 'conect.php';

    $search = $mysqli->real_escape_string($_POST['search']);

    if($nueva_consulta = $mysqli->prepare("
    select * from asesoria 
    where matricula = ".(int)$search."
    or nombre like '".$search."%'
    or id_materia = ".(int)$search."
    or materia like '".$search."%'
    ")){
        // $nueva_consulta->bind_param('i', $search, );
        $nueva_consulta->execute();
        $resultado = $nueva_consulta->get_result();

        if($resultado->num_rows >0){
            $rows = array();

            while($r = $resultado->fetch_assoc()){
                $rows[] = array('data' => $r);
            }

            echo json_encode(array('error' => false, 'resultado'=>$rows));
        } else{
            echo json_encode(array('error' => true));
        }
        $nueva_consulta->close();
    }

    $mysqli->close();
?>