<?php
include ('../classes/clase_controlador_juguetes.php');

if (isset($_POST['action'])){
    $action = $_POST['action'];
    if ($action == 'getJuguete') 
        getJuguete();
    else if ($action == 'getJuguetes')
        getJuguetes();
    else if ($action == 'getSinAutorizar')
    getSinAutorizar();
    else if ($action == 'Autorizar')
    Autorizar();
    else if ($action == 'setComent')
    setComent();
    else if ($action == 'eliminar')
    eliminar();
    else if ($action == 'getmisproductos')
    getmisproductos();
}
else {

    $videos = $_FILES['videos']['name'];


    $i =0;
    foreach($videos as $selected):
        $fileName = basename($selected);
        $videoType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedTypes = array("mp4", "wav");

        if (in_array($videoType, $allowedTypes)){
            $videoName = $_FILES["videos"]["tmp_name"][$i]; //accede a la carpeta temporal de imgs del servidor (XAMP)
            $video64 = base64_encode(file_get_contents($videoName)); //codifica los bits en base 64
            $realvideo[] = 'data:image/'. $videoType. ';base64, '.$video64;

        }else{
            echo "formato no valido.";
            exit();  
        }
        $i=$i+1;
    endforeach;


    $imagenes = $_FILES['imagenes']['name'];
    $i =0;
    foreach($imagenes as $selected):
        $fileName = basename($selected);
        $imageType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedTypes = array("png", "jpg", "gif");

        if (in_array($imageType, $allowedTypes)){
            $imageName = $_FILES["imagenes"]["tmp_name"][$i]; //accede a la carpeta temporal de imgs del servidor (XAMP)
            $image64 = base64_encode(file_get_contents($imageName)); //codifica los bits en base 64
            $_realImage[] = 'data:image/'. $imageType. ';base64, '.$image64;

        }else{
            echo "formato no valido.";
            exit();  
        }
        $i=$i+1;
    endforeach;

    //echo $_realImage[0];
    
    $categorias = $_POST['categoria_Selec'];

    if (!empty( $_FILES["perfil_producto"]["name"])){
        $fileName = basename($_FILES["perfil_producto"]["name"]);
        $imageType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedTypes = array("png", "jpg", "gif");

        if (in_array($imageType, $allowedTypes)){
            $imageName = $_FILES["perfil_producto"]["tmp_name"]; //accede a la carpeta temporal de imgs del servidor (XAMP)
            $image64 = base64_encode(file_get_contents($imageName)); //codifica los bits en base 64
            
            $_realImage2_icon = 'data:image/'. $imageType. ';base64, '.$image64;

        }else{
            echo "formato no valido.";
            exit();  
        }
    }else{
        echo "no subiste foto";
        exit();
    }

    session_start();
    $ID_VENDEDOR = $_SESSION['ID_USUARIO'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['Descripcion'];
    $precio = $_POST['precio'];
    $tipoVenta = $_POST['TipoVenta'];
    $cantidad = $_POST['cantidad'];
    $icono = $_realImage2_icon;
    $valoracion = 1;
    $registro = new JuguetesControlador($nombre, $descripcion, $tipoVenta, $valoracion , $precio, $cantidad, $ID_VENDEDOR,
     $icono, $categorias, "", $realvideo, $_realImage);
    $registro->PublicarJuguete();

    //header ("location: ../index.php?error=none");
}
function setComent(){

    session_start();

    $ID_USUARIO = $_SESSION['ID_USUARIO'];
    $ID_PRODUCTO = $_POST['ID_PRODUCTO'];
    $comentario = $_POST['comentario'];
    $estrellas = $_POST['estrellas'];

    $comentarios = new ComentariosControlador($estrellas, $comentario,  $ID_PRODUCTO, $ID_USUARIO);
    $comentarios->Comentar();
}

function getJuguetes(){
    $juguetes = new JuguetesControlador("", "", "", "", "", "", "", "", "", "", "", "");
    $juguetes->MostrarJuguetes();
}

function getJuguete(){
    $ID_PRODUCTO = $_POST['ID_PRODUCTO'];
    $juguete = new JuguetesControlador("", "", "", "", "", "", "", "", "", $ID_PRODUCTO, "", "");
    $juguete->VerJuguete();    
}

function getSinAutorizar(){
    $juguetes = new JuguetesControlador("", "", "", "", "", "", "", "", "", "", "", "");
    $juguetes->MostrarJuguetesSINAUTORIZAR();
}

function Autorizar(){
    $ID_PRODUCTO = $_POST['ID_PRODUCTO'];
    $juguete = new JuguetesControlador("", "", "", "", "", "", "", "", "", $ID_PRODUCTO, "", "");
    $juguete->AutorizarJuguete();    
}


function eliminar(){
    $ID_PRODUCTO = $_POST['ID_PRODUCTO'];
    $juguete = new JuguetesControlador("", "", "", "", "", "", "", "", "", $ID_PRODUCTO, "", "");
    $juguete->eliminarjuguete();    
}


function getmisproductos(){
    session_start();
    $ID_VENDEDOR = $_SESSION['ID_USUARIO'];
    $juguete = new JuguetesControlador("", "", "", "", "", "", $ID_VENDEDOR, "", "", "", "", "");
    $juguete->cargarproductos();    
}



