<?php
include ('../classes/database.php');


class PerfilActions extends Dbh {


    protected function ActualizarYa($nombre, $apellido, $nacimiento,  $usuario, $correo, $sexo, $privacidad, $foto, $ID_ROL, $ID_USUARIO){
        $stmt = $this-> connect()-> prepare('CALL sp_gestionUsuarios (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');	
        if (!$stmt->execute(array(5, $ID_USUARIO, $nombre, $apellido, $nacimiento, $usuario, $correo, null, $sexo, $privacidad, $foto, null))){
            $stmt = null;
            echo 'error'; exit();
        }
        $stmt = null;
        $_SESSION['correo_usuario'] = $correo;
        $_SESSION['username_usuario'] = $usuario;

    }

    protected function CargarInfo($usuario){
        $stmt = $this-> connect()-> prepare('CALL sp_gestionUsuarios (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');	

        if (!$stmt->execute(array(4, null, null, null, null, $usuario, null, null, null, null,null, null))){
            $stmt = null;
            header ("location: ../index.php?error=stmtfailed");
            exit();
        }

        $perfil = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;

        foreach ($perfil as $row): 
            $nombre = $row['nombre'];
            $apellido = $row['apellido'];
            $nacimiento = $row['nacimiento'];
            $usuario = $row['usuario'];
            $correo = $row['correo'];
            $sexo = $row['sexo'];
            $privacidad = $row['privacidad'];
            $foto = $row['foto'];
            $fechaCreacion = $row['fechaCreacion'];
            $lista_perfil[] = array("nombre" => $nombre, "apellido" => $apellido,"nacimiento" => $nacimiento, "usuario" => $usuario, "correo" => $correo, "sexo" => $sexo, "privacidad" => $privacidad, "foto" => $foto, "fechaCreacion" => $fechaCreacion);
        endforeach;

        echo json_encode($lista_perfil);
    } 

    protected function Bajalogica($ID_USUARIO){
        $stmt = $this-> connect()-> prepare('CALL sp_gestionUsuarios (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');
        if (!$stmt->execute(array(6, $ID_USUARIO, null, null, null, null, null, null, null, null,null, null))){ //false si no se pudo ejecutar
            $stmt = null;
            header ("location: ../index.php?error=stmtfailedCorreo");
            exit();
        }
        $check;
        //cuantas filas con el correo trajo el stmt
        if ($stmt->rowCount() > 0){
            $check = false;
        }
        else{
            $check = true;
        }
        return $check;
    }

    protected function RevisarCorreo($correo, $ID_USUARIO){
        $stmt = $this-> connect()-> prepare('CALL sp_GetCorreoContra (?, ?, ?, ?);');
        if (!$stmt->execute(array(1, null, $correo, $ID_USUARIO))){ //false si no se pudo ejecutar
            $stmt = null;
            header ("location: ../index.php?error=stmtfailedCorreo");
            exit();
        }
        $check;
        //cuantas filas con el correo trajo el stmt
        if ($stmt->rowCount() > 0){
            $check = false;
        }
        else{
            $check = true;
        }
        return $check;
    }

    protected function RevisarUsuario($usuario, $ID_USUARIO){
        $stmt = $this-> connect()-> prepare('CALL sp_GetCorreoContra (?, ?, ?, ?);');
        if (!$stmt->execute(array(2, $usuario, null, $ID_USUARIO))){ //false si no se pudo ejecutar
            $stmt = null;
            //header ("location: ../index.php?error=stmtfailedCorreo");
            exit();
        }
        $check;
        //cuantas filas con el correo trajo el stmt
        if ($stmt->rowCount() > 0){
            $check = false;
        }
        else{
            $check = true;
        }
        return $check;
    }
}



?>
