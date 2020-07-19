<?php
require_once '../Datos/DaoCategoria.php';
require_once '../Pojos/PojoCategoria.php';


// Recepción de los datos enviados mediante POST desde el JS   
$daoCategoria = new DaoCategoria();
$pojoCategoria = new PojoCategoria();
$dato = "";
$datos = "";


$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$estatus = (isset($_POST['estatus'])) ? $_POST['estatus'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //alta
        $pojoCategoria->id_categoria = null;
        $pojoCategoria->nombre = $nombre;
        $pojoCategoria->estatus = intval($estatus);
        $registro = $daoCategoria->registrarCategoria($pojoCategoria);
        $dato = $daoCategoria->getDatosCategoriaTabla();
        break;
    case 2: //modificación
        $pojoCategoria->id_categoria = $id;
        $pojoCategoria->nombre = $nombre;
        $pojoCategoria->estatus = $estatus;
        $registro = $daoCategoria->editarCategoria($pojoCategoria);
        $dato = $daoCategoria->getDatosCategoriaTabla();
       
        break;        
    case 3://baja
        $registro = $daoCategoria->EliminarEstatusCategoria($id);
        $dato = $daoCategoria->getDatosCategoriaTabla();
        
                               
        break;        
}



return json_encode($dato, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ; //enviar el array final en formato json a JS




class NegCategoria{

    function mostrar(){
        $daoCategoria = new DaoCategoria();
        $datos = $daoCategoria->getDatosCategoria();
        return $datos; 
    }
}





?>