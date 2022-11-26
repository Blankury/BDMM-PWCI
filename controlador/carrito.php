
<?php
include ('../classes/clase_controlador_carrito.php');

if (isset($_POST['action'])){
    $action = $_POST['action'];
    if ($action == 'getcarrito') 
    getcarrito();
    else if ($action == 'agregarproducto')
    agregarproducto();
    else if ($action == 'totalpagar')
    totalpagar();
    else if ($action == 'deleteJuguetefromCarrito')
    deleteJuguetefromCarrito();
    else if ($action == 'Pagar')
    Pagar();
    else if ($action == 'vaciar')
    vaciar();
    else if ($action == 'cotizar')
    cotizar();
    else if ($action == 'aceptarcot')
    aceptarcot();
    else if ($action == 'rechcot')
    rechcot();
    else if ($action == 'getcotiz')
    getcotiz();
}

function getcarrito(){
    session_start();
    $ID_USUARIO = $_SESSION['ID_USUARIO'];
    $carrito = new CarritoControlador("", "", "", $ID_USUARIO, "", "");
    $carrito->MostrarProuctos();
}

function agregarproducto(){
    session_start();
    $ID_USUARIO = $_SESSION['ID_USUARIO'];

    $cantidad = $_POST['cantidad'];
    $ID_PRODUCTO = $_POST['ID_PRODUCTO'];

    $carrito = new CarritoControlador("", $cantidad, "", $ID_USUARIO, "", $ID_PRODUCTO);
    $carrito->Agregarproductos();
}

function totalpagar(){
    session_start();
    $ID_USUARIO = $_SESSION['ID_USUARIO'];
    $carrito = new CarritoControlador("", "", "", $ID_USUARIO, "", "");
    $carrito->buscartotal();
}
function vaciar(){
    session_start();
    $ID_USUARIO = $_SESSION['ID_USUARIO'];
    $carrito = new CarritoControlador("", "", "", $ID_USUARIO, "", "");
    $carrito->vaciartodo();
}
function Pagar(){
    session_start();
    $ID_USUARIO = $_SESSION['ID_USUARIO'];
    $carrito = new CarritoControlador("", "", "", $ID_USUARIO, "", "");
    $carrito->Comprar();
}

function cotizar(){
    session_start();
    $ID_USUARIO = $_SESSION['ID_USUARIO'];
    $PrecioDado = $_POST['PrecioDado'];
    $ID_PRODUCTO = $_POST['ID_PRODUCTO'];

    $carrito = new CarritoControlador("", "", $PrecioDado, $ID_USUARIO, "", $ID_PRODUCTO);
    $carrito->AgregaraCotizacion();
}


function deleteJuguetefromCarrito(){
    session_start();

    $ID_USUARIO = $_SESSION['ID_USUARIO'];
    $ID_PRODUCTOQ = $_POST['ID_PRODUCTO'];
    $carrito = new CarritoControlador("", "",  "", $ID_USUARIO, "", $ID_PRODUCTOQ);
    $carrito->quitarproducto();
}


function aceptarcot(){
    session_start();
    $cotiz = $_POST['cotiz'];
    $ID_USUARIO = $_SESSION['ID_USUARIO'];
    $cotizar = new CarritoControlador($cotiz, "",  "", $ID_USUARIO, "", null);
    $cotizar->aceptarcotizacion();
}

function rechcot(){
    session_start();
    $cotiz = $_POST['cotiz'];
    $ID_USUARIO = $_SESSION['ID_USUARIO'];
    $cotizar = new CarritoControlador($cotiz, "",  "", $ID_USUARIO, "", null);
    $cotizar->rechazarcotizacion();
}

function getcotiz(){
    session_start();
    
    $ID_USUARIO = $_SESSION['ID_USUARIO'];
    $cotizar = new CarritoControlador("", "",  "", $ID_USUARIO, "", '');
    $cotizar->mostrarcotizaciones();
}