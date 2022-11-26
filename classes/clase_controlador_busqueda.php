<?php
include ('../classes/clase_busqueda.php');

class BusquedaControlador extends Search {
    private $busqueda;

    public function __construct($busqueda){
        $this->busqueda= $busqueda;
    }

    public function MostrarBuscados(){
        $this->CargarJuguetesBuscados($this->busqueda);      
    }
    
    private function inputVacio(){
        $check;
        if (empty($this->busqueda)){
            $check = false;
        }else {
            $check = true;
        }
        return $check;
    }

    
    public function cargarjuguetes(){
        $this->getporc($this->busqueda);
    }
}

?>