<?php
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
        require 'conect.php';
        sleep(1);
        
        session_start();

        $mysqli->set_charset('utf8');

        $user = $mysqli->real_escape_string($_POST['usuario']);
        $contra = $mysqli->real_escape_string($_POST['password']);
        $matricula = (int)$user;

        if($nueva_consulta = $mysqli->prepare("select estudiante.matricula, estudiante.nombre
        from estudiante inner join usuario
        on estudiante.matricula = usuario.matricula
        where (usuario.matricula = ?
        or usuario.nombre_usuario = ?)
        and usuario.password = ?")){
            
            $nueva_consulta->bind_param('iss', $matricula, $user, $contra);

            $nueva_consulta->execute();
            
            $resultado = $nueva_consulta->get_result();

            if($resultado->num_rows == 1){
                $datos = $resultado->fetch_assoc();
                $_SESSION['usuario'] = $datos;
                echo json_encode(array('error' => false, 'matricula'=>$datos['matricula'], 'nombre'=>$datos['nombre']));
            } else{
                echo json_encode(array('error' => true));
            }
            $nueva_consulta->close();
        }
        $mysqli->close();
    }
?>
