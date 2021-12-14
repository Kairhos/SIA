<?php
    require 'conect.php';

    $matricula = $mysqli->real_escape_string($_POST['matricula']);

    if($nueva_consulta = $mysqli->prepare("select estudiante.matricula, estudiante.nombre, estudiante.apellido_p,
    estudiante.apellido_m, estudiante.semestre, estudiante.edad,
    estudiante.sexo, facultad.nombre_facultad, carrera.nombre_carrera, carrera.id_plan, usuario.tipo_usuario
    from (((estudiante inner join carrera
    on estudiante.id_carrera = carrera.id_carrera)
    inner join facultad 
    on estudiante.id_facultad = facultad.id_facultad)
    inner join usuario 
    on estudiante.matricula = usuario.matricula)
    where estudiante.matricula = ?")){
        $nueva_consulta->bind_param('i', $matricula);
        $nueva_consulta->execute();
        $resultado = $nueva_consulta->get_result();

        if($resultado->num_rows == 1){
            $datos = $resultado->fetch_assoc();
            echo json_encode($datos);
        } else{
            echo json_encode(array('error' => true));
        }
        $nueva_consulta->close();
    }

    $mysqli->close();
?>