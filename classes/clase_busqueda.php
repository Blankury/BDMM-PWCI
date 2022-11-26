<?php
include ('../classes/database.php');


class Search extends Dbh {
 
    protected function CargarJuguetesBuscados($busqueda){
        $lista_info = array(
            'jug' => array(),
            'jugcaro' => array(),
            'usuarios' => array()
        );
        $stmt = $this-> connect()-> prepare('CALL sp_gestionBusqueda (?, ?);');	
        if (!$stmt->execute(array(1, '%'.$busqueda.'%'))){
            $stmt = null;
            echo "error en la busqueda de juguetes.";
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
            $lista_info['jug'][] = array("nombre" => $nombre,"precio" => $precio, "tipoVenta" => $tipoVenta,
            "vendedor" => $vendedor, "icono" => $icono,  "ID_PRODUCTO" => $ID_PRODUCTO);
        endforeach;


        $stmt = null; 

        $stmt = $this-> connect()-> prepare('CALL sp_gestionBusqueda (?, ?);');	
        if (!$stmt->execute(array(2, '%'.$busqueda.'%'))){
            $stmt = null;
            echo "error en la busqueda de juguetes.";
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
            $lista_info['jugcaro'][] = array("nombre" => $nombre,"precio" => $precio, "tipoVenta" => $tipoVenta,
            "vendedor" => $vendedor, "icono" => $icono,  "ID_PRODUCTO" => $ID_PRODUCTO);
        endforeach;


        $stmt = null; 
        
        $stmt = $this-> connect()-> prepare('CALL sp_gestionBusqueda (?, ?);');	
        if (!$stmt->execute(array(3, '%'.$busqueda.'%'))){
            $stmt = null;
            echo "error en la busqueda de usuarios.";
            //header ("location: ../index.php?error=stmtfailed");
            exit();
        }

        $juguetes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($juguetes as $row): 
            $usuario = $row['usuario'];
            $lista_info['usuarios'][] = array("usuario" => $usuario);
        endforeach;

        $stmt = null; 

        echo json_encode($lista_info);
    }




    protected function getporc($busqueda){
        $stmt = $this-> connect()-> prepare('CALL sp_gestionBusqueda (?, ?);');	
        if (!$stmt->execute(array(4, '%'.$busqueda.'%'))){
            $stmt = null;
            echo "error en la busqueda de juguetes.";
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
            $categorias = $row['categorias'];


            $juguetess[] = array("nombre" => $nombre,"precio" => $precio, "tipoVenta" => $tipoVenta,
            "vendedor" => $vendedor, "icono" => $icono,  "ID_PRODUCTO" => $ID_PRODUCTO, "categorias" => $categorias) ;
        endforeach;


        $stmt = null; 
        echo json_encode($juguetess);
    }
}



?>
