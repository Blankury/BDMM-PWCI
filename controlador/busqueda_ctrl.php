<?php
include ('../classes/clase_controlador_busqueda.php');

if (isset($_GET['action'])){
    $action = $_GET['action'];
    if ($action == 'searchUser') 
    searchUser();
    else if ($action == 'searchToys')
    searchToys();
    else if ($action == 'getporCategoria')
    getporCategoria();
}

function searchToys(){
    $busqueda = $_GET['busqueda'];
    $buscar = new BusquedaControlador($busqueda);
    $buscar->MostrarBuscados();
}

function searchUser(){
    $busqueda = $_GET['busqueda'];

    $buscar = new BusquedaControlador($busqueda);
    $buscar->MostrarBuscados();
}


function getporCategoria(){
    $busqueda = $_GET['busqueda'];

    $buscar = new BusquedaControlador($busqueda);
    $buscar->cargarjuguetes();    
}
