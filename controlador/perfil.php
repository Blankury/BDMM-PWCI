<?php
include ('../classes/clase_controlador_perfil.php');

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'deleteUser') 
        deleteUser();
    else if ($action == 'getInfouser')
        getInfouser();
    else if ($action == 'desactivar')
     desactivar();
    else if ($action == 'getPERFIL')
    getPERFIL();
}

else {
    $_realImage = 'null';

    if (!empty( $_FILES["foto"]["name"])){
        
        $fileName = basename($_FILES["foto"]["name"]);
        $imageType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedTypes = array("png", "jpg", "gif");

        if (in_array($imageType, $allowedTypes)){
            $imageName = $_FILES["foto"]["tmp_name"]; //accede a la carpeta temporal de imgs del servidor (XAMP)
            $image64 = base64_encode(file_get_contents($imageName)); //codifica los bits en base 64
            
            $_realImage = 'data:image/'. $imageType. ';base64, '.$image64;

        }else{
            echo "formato no valido.";
            exit();  
        }
    }
    $privacidad = "Publico" ;

    $nombre = $_POST['ednombre'];
    $apellido = $_POST['edapellido'];
    $nacimiento = $_POST['ednacimiento'];
    $usuario = $_POST['edusuario'];
    $correo = $_POST['edcorreoUsuario'];
    $foto = $_realImage;
    $sexo = $_POST['Sexo'];
    if (isset($_POST["Privacidad"])){
        $privacidad = $_POST['Privacidad'];
    }

    session_start();

    $ID_USUARIO = $_SESSION['ID_USUARIO'];
    $ID_ROL = $_SESSION['ID_ROL'];
    
    $perfil = new PerfilControlador($nombre, $apellido, $nacimiento, $usuario, $correo, $sexo, $privacidad, $foto, $ID_ROL, $ID_USUARIO); 

    $perfil->ActualizarInfo();

}


function getInfouser() {

    session_start();

    $ID_USUARIO = $_SESSION['ID_USUARIO'];
    $usuario = $_SESSION['username_usuario'];

    $perfil = new PerfilControlador("", "", "", $usuario, "", "", "", "", "", $ID_USUARIO); 
    $perfil->Mostrar();
    //header ("location: ../inicio.php?error=none");
}

function desactivar() {
    
    session_start();

    $ID_USUARIO = $_SESSION['ID_USUARIO'];
    $perfil = new PerfilControlador("", "", "", "", "", "", "", "", "", $ID_USUARIO); 
    $perfil->desactivarcuenta();

    session_destroy();
    //header ("location: ../inicio.php?error=none");
}

function getPERFIL() {

    session_start();
    $ID_USUARIO = $_SESSION['ID_USUARIO'];
    $usuario = $_SESSION['username_usuario'];
    $usuariourl = $_POST['user'];
    
    if ($usuario == $usuariourl){
        $perfil = new PerfilControlador("", "", "", $usuario, "", "", "", "", "", $ID_USUARIO); 
        $perfil->Mostrar();
    }else{
        $perfil = new PerfilControlador("", "", "", $usuariourl, "", "", "", "", "", ""); 
        $perfil->Mostrar();
    }
}
