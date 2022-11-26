<?php
include ('../classes/database.php');


class Carrito extends Dbh {
    protected function Añadir($ID_PRODUCTOS, $cantidadCompra, $ID_CLIENTE){
        $stmt = $this->connect()->prepare('CALL sp_gestionCarrito (?, ?, ?, ?, ?)');

        if (!$stmt->execute(array(1, $ID_PRODUCTOS,  $ID_CLIENTE, null,$cantidadCompra ))){
            $stmt = null;
            header ("location: ../index.php?error=stmtfailed");
            echo 'Error al insertar';
            exit();
        }

        $stmt = null; 
    } 
    protected function Cargar($ID_CLIENTE){   
        $stmt = $this-> connect()-> prepare('CALL sp_gestionCarrito (?, ?, ?, ?, ?);');	
        if (!$stmt->execute(array(2, null, $ID_CLIENTE, null, null))){
            $stmt = null;
            header ("location: ../index.php?error=erroralcargarproductos");
            exit();
        }

        $juguetes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($juguetes as $row): 
            $ID_CARRITO = $row['ID_CARRITO'];
            $ID_JUGUETE = $row['ID_JUGUETE'];
            $preciocotizado = $row['preciocotizado'];
            $cantidadCompra = $row['cantidadCompra'];
            $nombre = $row['nombre'];
            $precio = $row['precio'];
            $icono = $row['icono'];
            $cantidad = $row['cantidad'];

            $lista_jug[] = array("cantidad" => $cantidad, "ID_CARRITO" => $ID_CARRITO, "ID_JUGUETE" => $ID_JUGUETE, "preciocotizado" => $preciocotizado, "cantidadCompra" => $cantidadCompra, "nombre" => $nombre, "precio" => $precio, "icono" => $icono);
        endforeach;

        $stmt = null;

        echo json_encode($lista_jug);
    }

   
    protected function Compra($ID_CLIENTE){
        $stmt = $this->connect()->prepare('CALL sp_gestionCarrito (?, ?, ?, ?, ?)');

        if (!$stmt->execute(array(3, null, $ID_CLIENTE, null, null))){
            $stmt = null;
            //header ("location: ../index.php?error=stmtfailed");
            echo "error al comprar";
            exit();
        }

        $stmt = null; 
    } 

    protected function calculartotal ($ID_CLIENTE){
        $stmt = $this->connect()->prepare('CALL sp_gestionCarrito (?, ?, ?, ?, ?)');


        if (!$stmt->execute(array(4, null, $ID_CLIENTE, null, null))){
            $stmt = null;
            header ("location: ../index.php?error=erroralcargartotal");
            exit();
        }

        $total = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $total_json = $total[0]['total'];

        $stmt = null;

        echo json_encode($total_json);

    }
    protected function vaciar($ID_CLIENTE){
        $stmt = $this->connect()->prepare('CALL sp_gestionCarrito (?, ?, ?, ?, ?)');

        if (!$stmt->execute(array(5, null, $ID_CLIENTE, null, null))){
            $stmt = null;
            header ("location: ../index.php?error=stmtfailed");
            exit();
        }

        $stmt = null; 
    } 
    protected function cotizacion($ID_CLIENTE, $ID_PRODUCTOS, $precioPagar){
        $stmt = $this->connect()->prepare('CALL sp_gestionCarrito (?, ?, ?, ?, ?)');

        if (!$stmt->execute(array(7, $ID_PRODUCTOS, $ID_CLIENTE, $precioPagar, null))){
            $stmt = null;
            echo 'error al solicitar cotizacion';
            exit();
        }

        $stmt = null; 
    } 

    protected function quitar($ID_CLIENTE, $ID_PRODUCTOS){
        $stmt = $this->connect()->prepare('CALL sp_gestionCarrito (?, ?, ?, ?, ?)');

        if (!$stmt->execute(array(6, $ID_PRODUCTOS,  $ID_CLIENTE, null, null ))){
            $stmt = null;
            echo 'Error al eliminar el producto';
            exit();
        }

        $stmt = null; 
    } 


    protected function aceptar($ID_cotizacion, $ID_VENDEDOR){
        $stmt = $this->connect()->prepare('CALL sp_cotizaciones (?, ?,  ?, ?)');

        if (!$stmt->execute(array(1, null,  $ID_VENDEDOR, $ID_cotizacion ))){
            $stmt = null;
            echo 'Error al aceptar';
            exit();
        }

        $stmt = null; 
    }  protected function rechazar($ID_cotizacion, $ID_VENDEDOR){
        $stmt = $this->connect()->prepare('CALL sp_cotizaciones (?, ?, ?, ?)');

        if (!$stmt->execute(array(2, null,  $ID_VENDEDOR, $ID_cotizacion ))){
            $stmt = null;
            echo 'Error al rechazar';
            exit();
        }

        $stmt = null; 
    }  protected function cargarcotizaciones($ID_VENDEDOR){
        $stmt = $this->connect()->prepare('CALL sp_cotizaciones (?, ?, ?, ?)');

        if (!$stmt->execute(array(3, null, $ID_VENDEDOR, null ))){
            $stmt = null;
            echo 'Error al cargar cotizaciones';
            exit();
        }


        $cot = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($cot as $row): 
            $ID_JUGUETE = $row['ID_JUGUETE'];
            $nombre = $row['nombre'];
            $ID_cotizacion = $row['ID_cotizacion'];
            $ID_USUARIO = $row['ID_USUARIO'];
            $precio = $row['precio'];
            $usuario = $row['usuario'];
            
            $lista_COTIZACIONES[] = array("ID_JUGUETE" => $ID_JUGUETE, "nombre" => $nombre, 
            "ID_cotizacion" => $ID_cotizacion, "ID_USUARIO" => $ID_USUARIO, "precio" => $precio, "usuario" => $usuario);
        endforeach;

        $stmt = null;

        echo json_encode($lista_COTIZACIONES);
    } 
    
}



?>