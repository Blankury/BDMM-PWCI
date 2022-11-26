<?php
include ('../classes/database.php');


class Toys extends Dbh {
    protected function insertarJuguete($nombre, $descripcion, $tipoVenta,  $valoracion, $precio, $cantidad, $ID_VENDEDOR, $icono, $categorias, $videos, $imagenes){
        $stmt = $this->connect()->prepare('call sp_gestionJuguetes(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');
        if (!$stmt->execute(array(1, null, $nombre, $descripcion, $tipoVenta, $valoracion, $precio, $cantidad, $ID_VENDEDOR, $icono, null, null, null, null, null))){
            $stmt = null;
            echo "error en la insercion.";
            //header ("location: ../index.php?error=stmtfailed");
            exit();
        }
        $stmt = null;

        $stmt = $this->connect()->query('SELECT ID_PRODUCTO FROM juguetes ORDER BY ID_PRODUCTO DESC LIMIT 1;');
        $juguetes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($juguetes as $row): 
            $ID_JUGUETE = $row['ID_PRODUCTO'];

        endforeach;
        $stmt = null;

        foreach($categorias as $categoria):
            $stmt = $this->connect()->prepare('call sp_gestionJuguetes(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');
            if (!$stmt->execute(array(4, $ID_JUGUETE, null, null, null, null, null, null, null, null, $categoria, null, null, null, null))){
                $stmt = null;
                //header ("location: ../index.php?error=stmtfailed");
                echo"error en las categorias";
                exit();
            }
        endforeach;
    
        $stmt = null;

        foreach($videos as $video):
            $stmt = $this->connect()->prepare('call sp_gestionJuguetes(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');
            if (!$stmt->execute(array(3, $ID_JUGUETE, null, null, null, null, null, null, null, null, null, "videos/".$video, null, null, null))){
                $stmt = null;
                echo"error en los videos";
                //header ("location: ../index.php?error=stmtfailed");
                exit();
            }
        endforeach;
    
        $stmt = null;
        foreach($imagenes as $imagen):
            $stmt = $this->connect()->prepare('call sp_gestionJuguetes(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');
            if (!$stmt->execute(array(2, $ID_JUGUETE, null, null, null, null, null, null, null, null, null, null, $imagen, null, null))){
                $stmt = null;
                echo"error en las imagenes";
                //header ("location: ../index.php?error=stmtfailed");
                exit();
            }
        endforeach;
    
        $stmt = null;
        
    }

    protected function jugueteIndividual($ID_JUGUETE){
        $lista_info = array(
            'jug' => array(),
            'coment' => array(),
            'imgs' => array(),
            'vids' => array()
        );

        $stmt = $this->connect()->prepare('call sp_infoJUGUETE (?, ?);');
        
        if (!$stmt->execute(array(1, $ID_JUGUETE))){
            $stmt = null;
            //header ("location: ../index.php?error=stmtfailed");
            exit();
        }
        
        $juguetes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($juguetes as $row): 
            $nombre = $row['nombre'];
            $descripcion = $row['descripcion'];
            $precio = $row['precio'];
            $tipoVenta = $row['tipoVenta'];
            $cantidad = $row['cantidad'];
            $valoracion = $row['valoracion'];
            $vendedor = $row['vendedor'];
            $icono = $row['icono'];
            $categorias = $row['categorias'];
            //traerme el nombre del vendedor tambien.
            $lista_info['jug'][] = array("nombre" => $nombre, "descripcion" => $descripcion,
            "precio" => $precio, "tipoVenta" => $tipoVenta, "cantidad" => $cantidad,
            "valoracion" => $valoracion, "vendedor" => $vendedor, "icono" => $icono, "categorias" => $categorias);
        endforeach;

        $stmt = null; 

        $stmt = $this->connect()->prepare('call sp_infoJUGUETE (?, ?);');
        
        if (!$stmt->execute(array(4, $ID_JUGUETE))){
            $stmt = null;
            echo "Error al cargar las imagenes.";

            //header ("location: ../index.php?error=stmtfailed");
            exit();
        }
        
        $imgs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($imgs as $row): 
            $imagen = $row['imagen'];
            $lista_info['imgs'][] = array("imagen" => $imagen);
        endforeach;

        $stmt = null; 

        $stmt = $this->connect()->prepare('call sp_infoJUGUETE (?, ?);'); 

        if (!$stmt->execute(array(3, $ID_JUGUETE))){
            $stmt = null;
            echo "Error al cargar videos.";

            //header ("location: ../index.php?error=stmtfailed");
            exit();
        }
        
        $videos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($videos as $row): 
            $video = $row['video'];
            $lista_info['vids'][] = array("video" => $video);
        endforeach;

        $stmt = null; 
        
        $stmt = $this->connect()->prepare('call sp_infoJUGUETE (?, ?);');
        
        
        if (!$stmt->execute(array(2, $ID_JUGUETE))){
            $stmt = null;
            echo "Error al cargar comentarios.";
            //header ("location: ../index.php?error=stmtfailed");
            exit();
        }
        
        $comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($comentarios as $row): 
            $fechaCreacion = $row['fechaCreacion'];
            $descripcionc = $row['descripcion'];
            $calificación = $row['calificación'];
            $foto = $row['foto'];
            $usuario = $row['usuario'];

            $lista_info['coment'][] = array("fechaCreacion" => $fechaCreacion, "foto" => $foto, 
            "descripcionc" => $descripcionc,"calificación" => $calificación, "usuario" => $usuario);
        endforeach;

        $stmt = null;

       

        echo json_encode($lista_info);
        
    }

    protected function CargarJuguetes(){
        $lista_info = array(
            'jug' => array(),
            'categs' => 1
        );
        $stmt = $this->connect()->prepare('call sp_gestionJuguetes(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');

        if (!$stmt->execute(array(6, null, null, null, null, null, null, null, null, null, null, null, null, null, null))){
            $stmt = null;
            echo "error en la insercion.";
            //header ("location: ../index.php?error=stmtfailed");
            exit();
        }

        $juguetes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($juguetes as $row): 
            $nombre = $row['nombre'];
            $precio = $row['precio'];
            $tipoVenta = $row['tipoVenta'];
            $vendedor = $row['vendedor'];
            $icono = $row['icono'];
            $ID_PRODUCTO = $row['ID_PRODUCTO'];
            $ventas = $row['ventas'];
            $lista_info['jug'][] = array("nombre" => $nombre,"precio" => $precio, "tipoVenta" => $tipoVenta,
            "vendedor" => $vendedor, "icono" => $icono,  "ID_PRODUCTO" => $ID_PRODUCTO,  "ventas" => $ventas);
        endforeach;

        $stmt = null; 
        echo json_encode($lista_info);
    }


    protected function CargarJuguetesSINAUTORIZAR(){
        $stmt = $this->connect()->prepare('call sp_gestionJuguetes(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');

        if (!$stmt->execute(array(5, null, null, null, null, null, null, null, null, null, null, null, null, null, null))){
            $stmt = null;
            //header ("location: ../index.php?error=stmtfailed");
            exit();
        }
        
        $juguetes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($juguetes as $row): 
            $nombre = $row['nombre'];
            $descripcion = $row['descripcion'];
            $precio = $row['precio'];
            $tipoVenta = $row['tipoVenta'];
            $cantidad = $row['cantidad'];
            $valoracion = $row['valoracion'];
            $vendedor = $row['vendedor'];
            $ID_PRODUCTO = $row['ID_PRODUCTO'];
            $icono = $row['icono'];
            $video = $row['video'];
            $imagenes = $row['imagenes'];
            $categorias = $row['categorias'];
            $lista_info[] = array("nombre" => $nombre, "descripcion" => $descripcion, "precio" => $precio, "tipoVenta" => $tipoVenta, "cantidad" => $cantidad,
            "valoracion" => $valoracion, "vendedor" => $vendedor, "icono" => $icono,  "ID_PRODUCTO" => $ID_PRODUCTO, "categorias" => $categorias, "video" => $video, "imagenes" => $imagenes, );
        endforeach;

        $stmt = null; 
      

        echo json_encode($lista_info);
        
    }





    protected function accioneliminarjuguete($ID_PRODUCTO){
        $stmt = $this->connect()->prepare('call sp_infoJUGUETE(?, ?);');

        if (!$stmt->execute(array(5, $ID_PRODUCTO))){
            $stmt = null;
            echo 'error';
            exit();
        }
        
        $stmt = null; 
        
    }


    protected function cargarautorizado($ID_VENDEDOR){
        $stmt = $this->connect()->prepare('call sp_MISJUGUETES(?);');
        if (!$stmt->execute(array($ID_VENDEDOR))){
            $stmt = null;
            echo "error.";
            //header ("location: ../index.php?error=stmtfailed");
            exit();
        }

        $juguetes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($juguetes as $row): 
            $nombre = $row['nombre'];
            $descripcion = $row['descripcion'];
            $precio = $row['precio'];
            $tipoVenta = $row['tipoVenta'];
            $autorizado = $row['autorizado'];
            $cantidad = $row['cantidad'];
            $valoracion = $row['valoracion'];
            $vendedor = $row['vendedor'];
            $ID_PRODUCTO = $row['ID_PRODUCTO'];
            $icono = $row['icono'];
            $video = $row['video'];
            $imagenes = $row['imagenes'];
            $categorias = $row['categorias'];
            $lista_info[] = array("autorizado" => $autorizado, "nombre" => $nombre, "descripcion" => $descripcion, "precio" => $precio, "tipoVenta" => $tipoVenta, "cantidad" => $cantidad,
            "valoracion" => $valoracion, "vendedor" => $vendedor, "icono" => $icono,  "ID_PRODUCTO" => $ID_PRODUCTO, "categorias" => $categorias, "video" => $video, "imagenes" => $imagenes, );
        endforeach;

        $stmt = null; 
      

        echo json_encode($lista_info);        
    }


    protected function Autorizar($ID_PRODUCTO){
        $stmt = $this->connect()->prepare('call sp_autorizar(?);');
        if (!$stmt->execute(array($ID_PRODUCTO))){
            $stmt = null;
            echo "error en la autoriacion.";
            //header ("location: ../index.php?error=stmtfailed");
            exit();
        }
        $stmt = null;   
        
    }

    protected function InsertarComentario($calificacion, $comentario,  $ID_PRODUCTO, $ID_USUARIO){
        $stmt = $this->connect()->prepare('call sp_comentarios(?,?,?,?,?);');
        if (!$stmt->execute(array(1, $ID_PRODUCTO, $comentario, $calificacion, $ID_USUARIO))){
            $stmt = null;
            echo 2;
            //header ("location: ../index.php?error=stmtfailed");
            exit();
        }
        
        $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($respuesta[0]['total']  > 0){
            $stmt = null;
            echo 1;
            exit();
        }else{
            $stmt = null;
            echo 'Comentaste.';
            exit();
        }


       


    }
}



?>
