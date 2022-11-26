<?php
include ('../classes/clase_juguetes.php');

class JuguetesControlador extends Toys {
    private $nombre;
    private $descripcion;
    private $tipoVenta;
    private $valoracion;
    private $precio;
    private $cantidad;
    private $ID_VENDEDOR;
    private $icono;    
    private $categorias;
    private $videos;
    private $imagenes;

    private $ID_PRODUCTO;

    private $ID_ADMIN;
    private $autorizado;
    private $fechaCreacion;//

    public function __construct($nombre, $descripcion, $tipoVenta, $valoracion, $precio, $cantidad, $ID_VENDEDOR, $icono,
    $categorias, $ID_PRODUCTO,  $videos, $imagenes){
        $this->nombre= $nombre;
        $this->descripcion= $descripcion;
        $this->tipoVenta= $tipoVenta;
        $this->valoracion= $valoracion;
        $this->precio= $precio;
        $this->cantidad= $cantidad;
        $this->ID_VENDEDOR= $ID_VENDEDOR;
        $this->icono= $icono;
        $this->categorias= $categorias;
        $this->videos= $videos;
        $this->imagenes= $imagenes;


        $this->ID_PRODUCTO= $ID_PRODUCTO;
    }

    public function PublicarJuguete(){
        if ($this->inputVacio() == false ){
            echo "Llena todos los campos.";
            //header ("location: ../index.php?error=inputVacio");
            exit();
            
        }
        $this->insertarJuguete($this->nombre, $this->descripcion, $this->tipoVenta, $this->valoracion, $this->precio,  $this->cantidad, $this->ID_VENDEDOR, $this->icono, $this->categorias, $this->videos, $this->imagenes);
        echo "Producto enviado a revision."; 
    }

    public function MostrarJuguetes(){
        $this->CargarJuguetes();      
    }

    public function VerJuguete(){
        $this->jugueteIndividual($this->ID_PRODUCTO);      
    }
    
    public function MostrarJuguetesSINAUTORIZAR(){
        $this->CargarJuguetesSINAUTORIZAR();      
    }

    public function AutorizarJuguete(){
        $this->Autorizar($this->ID_PRODUCTO);
        echo "Se ha autorizado el producto.";     
    }
    public function eliminarjuguete(){
        $this->accioneliminarjuguete($this->ID_PRODUCTO);
        echo "Se ha eliminado el producto.";     
    }
    public function cargarproductos(){
        $this->cargarautorizado($this->ID_VENDEDOR);
    }

    private function inputVacio(){
        $check;
        if (empty($this->descripcion) || empty ($this->tipoVenta) || empty ($this->nombre) ||empty ($this->valoracion) || empty ($this->categorias)  || empty ($this->cantidad)  ||  empty ($this->precio)|| empty ($this->ID_VENDEDOR) || empty ($this->icono)|| empty ($this->videos)|| empty ($this->imagenes)){
            $check = false;
        }else {
            $check = true;
        }
        return $check;
    }
}


class ComentariosControlador extends Toys {
    private $calificacion;
    private $comentario;
    private $ID_PRODUCTO;
    private $ID_USUARIO;

    public function __construct($calificacion, $comentario,  $ID_PRODUCTO, $ID_USUARIO){
        $this->calificacion= $calificacion;
        $this->ID_USUARIO= $ID_USUARIO;
        $this->comentario= $comentario;
        $this->ID_PRODUCTO= $ID_PRODUCTO;
    }

    public function Comentar(){
        if ($this->inputVacio() == false ){
            echo 3;
            //header ("location: ../index.php?error=inputVacio");
            exit();
        }
        $this->InsertarComentario($this->calificacion, $this->comentario, $this->ID_PRODUCTO, $this->ID_USUARIO);
    }

    private function inputVacio(){
        $check;
        if (empty($this->calificacion) || empty ($this->comentario)  ||  empty ($this->ID_PRODUCTO)|| empty ($this->ID_USUARIO) ){
            $check = false;
        }else {
            $check = true;
        }
        return $check;
    }

}

?>