<?php
include ('../classes/clase_perfil.php');

class PerfilControlador extends PerfilActions {
    private $correo;
    private $usuario;
    private $nacimiento;
    private $sexo;
    private $nombre;
    private $apellido;
    private $ID_ROL;
    private $privacidad;
    private $foto;
    private $ID_USUARIO;
    public $result = 0;

    public function __construct($nombre, $apellido, $nacimiento, $usuario, $correo, $sexo, $privacidad, $foto, $ID_ROL, $ID_USUARIO){
        $this->nombre= $nombre;
        $this->apellido= $apellido;
        $this->nacimiento= $nacimiento;
        $this->usuario= $usuario;
        $this->correo= $correo;
        $this->sexo= $sexo;
        $this->privacidad= $privacidad;
        $this->foto= $foto;
        $this->ID_ROL= $ID_ROL;
        $this->ID_USUARIO= $ID_USUARIO;

    }

    public function ActualizarInfo(){
        if ($this->inputVacio() == false ){
            echo "Llena todos los datos";
            exit();
            
        }    

        if ($this->correoUnico() == false ){
            echo "El correo ya existe.";
            exit();
        }
        if ($this->usuarioUnico() == false ){
            echo "Nombre de usuario en uso.";
            exit();
        }
        
        $this->ActualizarYa($this->nombre, $this->apellido, $this->nacimiento, $this->usuario,  $this->correo, $this->sexo, $this->privacidad, $this->foto, $this->ID_ROL, $this->ID_USUARIO);
        echo 1;
         
    }

    public function Mostrar(){
        $this->CargarInfo($this->usuario);
    }

    public function desactivarcuenta(){
        $this->Bajalogica($this->ID_USUARIO);
    }

    private function inputVacio(){
        $check;
        if (empty($this->nombre) || empty ($this->apellido) || empty ($this->nacimiento) ||empty ($this->usuario)  || empty ($this->correo) || empty ($this->sexo) || empty ($this->ID_ROL)){
            $check = false;
        }else {
            $check = true;
        }
        return $check;
    }
    
    private function correoUnico (){
        $check;
        if (!$this->RevisarCorreo($this->correo, $this->ID_USUARIO)){
            $check = false;
        }else {
            $check = true;
        }
        return $check;
    }

    private function usuarioUnico (){
        $check;
        if (!$this->RevisarUsuario($this->usuario, $this->ID_USUARIO)){
            $check = false;
        }else {
            $check = true;
        }
        return $check;
    }
}

?>